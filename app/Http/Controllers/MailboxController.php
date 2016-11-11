<?php

namespace App\Http\Controllers;

use App\MailItem;
use Auth;
use Validator;
use File;
use Storage;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;

class MailboxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * checks the total number of corresponding MailItem types and updates in the view asynchronously
     * this call is initialized from an ajax function block
     */
    public function check(){
        $numInbox = $numSent = $numDrafts = 0;

        $numInbox = count(Auth::user()->mailitems()
                                   ->where('is_sent', 0)
                                   ->where('is_draft', 0)
                                   ->where('status', 0)
                                   ->get());
        $numSent = count(Auth::user()->mailitems()->where('is_sent', 1)->get());
        $numDrafts = count(Auth::user()->mailitems()->where('is_draft', 1)->get());

        session(['noInbox' => $numInbox, 'noSent' => $numSent, 'noDrafts' => $numDrafts]);

        return response()->json(['numInbox' => $numInbox, 'numSent' => $numSent, 'numDrafts' => $numDrafts], 200);
    }

    public function getCompose(){
        return view('compose');
    }

    /**
     * handles composed mails
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function postCompose(Request $request){
        $validator = Validator::make($request->all(), [
            'recipient' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'body' => 'required',
            'attachment' => 'file|max:10000',
        ], ['subject.required' => 'The subject of this message cannot be more than 255 characters.', 'recipient.required' => 'Please enter the email of the recipient.', 'body.required' => 'Enter the message.', 'attachment' => 'Ensure that the attachment you want to upload is not more than 10 MB and it\'s caption is less than 255 characters']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        if(isset($request->save)){
            $this->save($request, true, false);
            return redirect('/mailbox/compose')->with(['saved' => 'Your draft has been saved.']);
        } elseif (isset($request->send)){
            $sent = $this->send($request);

            if(!$sent){
                $this->save($request, true, false);
                return redirect('/mailbox/compose')->with(['notSent' => 'Unable to send mail. Saved as draft.']);
            }

            return redirect('/mailbox/compose')->with(['sent' => 'Your mail has been sent.']);
        }
    }

    public function inbox(){
        return view('inbox');
    }

    public function sent(){
        $sent_mails = Auth::user()->mailitems()->where('is_sent', 1)->orderBy('created_at', 'desc')->paginate(5);

        return view('sent', ['sent_mails' => $sent_mails]);
    }

    public function drafts(){
        $drafts = Auth::user()->mailitems()->where('is_draft', 1)->orderBy('created_at', 'desc')->paginate(5);

        return view('drafts', ['drafts' => $drafts]);
    }

    /**
     * read a MailItem depending on its category specified by the id
     * @param String $category
     * @param Integer $id
     */
    public function readmail($category, $id){
        $readmail = Auth::user()->mailitems()->where('id', $id)->first();

        $attachmentSize = null;

        if($readmail->attachment != ""){
            $path = Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
            $attachmentSize = Storage::disk('public')->size($path.$readmail->attachment);
        }

        $first = $last = null; // will hold instances of the first and last MailItem instances in the database respectively depending on the criteria specified

        if($category == "Inbox"){

        } else if($category == "Sent"){
            $first = Auth::user()->mailitems()->where('is_sent', 1)->first();
            $last = Auth::user()->mailitems()->where('is_sent', 1)->orderBy('id', 'desc')->first(); // returns last sent MailItem in the database
        } else {
            $first = Auth::user()->mailitems()->where('is_draft', 1)->first();
            $last = Auth::user()->mailitems()->where('is_draft', 1)->orderBy('id', 'desc')->first();  // returns last draft MailItem in the database
        }

        $next = $previous = null;

        $hasNext = $this->hasNext($readmail->id, $last->id);
        if($hasNext){
            if($category == "Inbox"){

            } else if($category == "Sent"){
                // set the id of the next MailItem
                $next = Auth::user()->mailitems()
                                  ->where('is_sent', 1)
                                  ->where('id', '>', $readmail->id)
                                  ->first()->id;
            } else {
                // set the id of the previous MailItem
                $next = Auth::user()->mailitems()
                                    ->where('is_draft', 1)
                                    ->where('id', '>', $readmail->id)
                                    ->first()->id;
            }
        }

        $hasPrevious = $this->hasPrevious($readmail->id, $first->id);
        if($hasPrevious){
            if($category == "Inbox"){

            } else if($category == "Sent"){
                // set the id of the next MailItem
                $previous = Auth::user()->mailitems()
                                  ->where('is_sent', 1)
                                  ->where('id', '<', $readmail->id)
                                  ->orderBy('id', 'desc')
                                  ->first()->id;
            } else {
                // set the id of the previous MailItem
                $previous = Auth::user()->mailitems()
                                    ->where('is_draft', 1)
                                    ->where('id', '<', $readmail->id)
                                    ->orderBy('id', 'desc')
                                    ->first()->id;
            }
        }

        return view('readmail', ['category' => $category, 'readmail' => $readmail, 'attachmentSize' => $attachmentSize, 'next' => $next, 'previous' => $previous, 'hasNext' => $hasNext, 'hasPrevious' => $hasPrevious]);
    }

    /**
     * checks if there is a nextable MailItem instance in the database
     * @param Integer $current
     * @param Integer $last
     * @return Boolean
     */
    private function hasNext($current, $last){
        return ($current == $last) ? false : true;
    }

    /**
     * checks if there is a previousable MailItem instance in the database
     * @param Integer $current
     * @param invite $first
     * @return Boolean
     */
    private function hasPrevious($current, $first){
        return ($current == $first) ? false : true;
    }

    /**
     * stores a mail in the database
     * @param Request $request
     * @param Boolean $asDraft
     * @param Boolean $asSent
     * @return Boolean
     */
    private function save(Request $request, $asDraft = true, $asSent = true){
        if($request->hasFile('attachment')){
            $path = Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
            $filename = $request->attachment->getClientOriginalName();

            $mail_item = new MailItem();
            $mail_item->user_id = $request->user_id;
            $mail_item->sender = $request->sender;
            $mail_item->recipient = $request->recipient;
            $mail_item->subject = $request->subject;
            $mail_item->body = $request->body;
            $mail_item->attachment = $filename;
            $mail_item->status = 0;
            $mail_item->is_sent = ($asSent == true ? 1 : 0);
            $mail_item->is_draft = ($asDraft == true ? 1 : 0);
            $mail_item->save();

            Storage::disk('public')->put($path.$filename, File::get($request->attachment));
        } else {
            $mail_item = new MailItem();
            $mail_item = new MailItem();
            $mail_item->user_id = $request->user_id;
            $mail_item->sender = $request->sender;
            $mail_item->recipient = $request->recipient;
            $mail_item->subject = $request->subject;
            $mail_item->body = $request->body;
            $mail_item->status = 0;
            $mail_item->is_sent = ($asSent == true ? 1 : 0);
            $mail_item->is_draft = ($asDraft == true ? 1 : 0);
            $mail_item->save();
        }
    }

    /**
     * sends a mail to the specified recipient
     * @param Request $request
     * @return Boolean
     */
    private function send(Request $request){
        $sent = false;

        if($request->hasFile('attachment')){
            @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                $message->from(Auth::user()->email, Auth::user()->name);
                $message->to($request->recipient);
                $message->attach($request->attachment->getRealPath(), ['as' => $request->attachment->getClientOriginalName()]);
                $message->subject('iPub, a mail from an iPub account user');
            });

            $sent = true;
        } else {
            @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                $message->from(Auth::user()->email, Auth::user()->name);
                $message->to($request->recipient);
                $message->subject('iPub, a mail from an iPub account user');
            });

            $sent = true;
        }

        $this->save($request, false, true);

        return $sent;
    }

    /**
     * sends a draft or already stored message
     * @param Request $request
     * @param String $category
     */
    public function sendSaved(Request $request, $category){
        $sent = false;

        if($request->attachment == ""){
            @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                $message->from($request->sender, Auth::user()->name);
                $message->to($request->recipient);
                $message->subject('iPub, a mail from an iPub account user');
            });

            $sent = true;
        } else {
            $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
            @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                $message->from($request->sender, Auth::user()->name);
                $message->to($request->recipient);
                $path = Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
                $file = Storage::disk('public')->get($path.$request->attachment);
                $message->attachData($file, "iPub - ".$request->attachment);
                $message->subject('iPub, a mail from an iPub account user');
            });

            $sent = true;
        }

        if($sent){
            MailItem::find($request->id)->update(['is_sent' => 1]);
            return redirect('/mailbox/readmail/'.$category.'/'.$request->id)->with(['sent' => 'Your mail has been sent.']);
        } else {
            return redirect('/mailbox/readmail/'.$category.'/'.$request->id)->with(['notSent' => 'Unable to send mail. Please try again.']);
        }
    }

    /**
     * responsible for forwarding a mail
     * @param Request $request
     * @param String $category
     * @param Integer $id
     */
    public function forward(Request $request, $category){
        $validator = Validator::make($request->all(), [
            'recipient' => 'required|email|max:255',
        ], ['recipient.required' => 'Please enter the email of the recipient.']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        $forwarded = false;

        if($request->attachment == ""){
            @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                $message->from($request->sender, Auth::user()->name);
                $message->to($request->recipient);
                $message->subject('iPub, a mail from an iPub account user');
            });

            $forwarded = true;
        } else {
            $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
            @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                $message->from($request->sender, Auth::user()->name);
                $message->to($request->recipient);
                $path = Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
                $file = Storage::disk('public')->get($path.$request->attachment);
                $message->attachData($file, "iPub - ".$request->attachment);
                $message->subject('iPub, a mail from an iPub account user');
            });

            $forwarded = true;
        }

        if($forwarded){
            return redirect('/mailbox/readmail/'.$category.'/'.$request->id)->with(['sent' => 'Your mail has been forwarded.']);
        } else {
            return redirect('/mailbox/readmail/'.$category.'/'.$request->id)->with(['notSent' => 'Unable to forward mail. Please try again.']);
        }
    }

    /**
     * deletes a mail
     * @param String $category
     * @param Integer $id
     */
    public function delete($category, $id){
        $deleted = false;

        $deleted = $this->remove($category, $id);

        if($deleted){
             if($category == "Inbox"){
                 return redirect('/mailbox/inbox')->with('deleted', 'Mail has been deleted!');
             } elseif($category == "Sent") {
                 return redirect('/mailbox/sent')->with('deleted', 'Mail has been deleted!');
             } else {
                 return redirect('/mailbox/drafts')->with('deleted', 'Mail has been deleted!');
             }
         } else {
             if($category == "Inbox"){
                 return redirect('/mailbox/inbox')->with('notDeleted', 'Unable to delete mail. Please try again.');
             } elseif($category == "Sent") {
                 return redirect('/mailbox/sent')->with('notDeleted', 'Unable to delete mail. Please try again.');
             } else {
                 return redirect('/mailbox/drafts')->with('notDeleted', 'Unable to delete mail. Please try again.');
             }
         }
    }

    /**
     * deletes one or more mails checked by the checkbox html element
     * @param String $category
     * @param Array $ids
     */
    public function deleteMails($category, $ids){
        $ids = json_decode($ids);

        $deleted = false;

        if(count($ids) == 1){
            $deleted = $this->remove($category, $ids[0]);
        } else {
            foreach ($ids as $id) {
                $deleted = $this->remove($category, $id);
            }
        }

        if($deleted){
             if($category == "Inbox"){
                 return redirect('/mailbox/inbox')->with('deleted', 'Mail has been deleted!');
             } elseif($category == "Sent") {
                 return redirect('/mailbox/sent')->with('deleted', 'Mail has been deleted!');
             } else {
                 return redirect('/mailbox/drafts')->with('deleted', 'Mail has been deleted!');
             }
         } else {
             if($category == "Inbox"){
                 return redirect('/mailbox/inbox')->with('notDeleted', 'Unable to delete mail. Please try again.');
             } elseif($category == "Sent") {
                 return redirect('/mailbox/sent')->with('notDeleted', 'Unable to delete mail. Please try again.');
             } else {
                 return redirect('/mailbox/drafts')->with('notDeleted', 'Unable to delete mail. Please try again.');
             }
         }
    }

    /**
     * deletes a mail from the database
     * @param String $category
     * @param Integer $id
     * @return Boolean
     */
    private function remove($category, $id){
        $mail_item = Auth::user()->mailitems()->where('id', $id)->first();
        $deleted = false;

        if($mail_item->attachment){
            $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
            $mail_item->delete();
            File::delete($path.$mail_item->attachment);
            $deleted = true;
        } else {
            $mail_item->delete();
            $deleted = true;
        }

       return $deleted;
    }
}
