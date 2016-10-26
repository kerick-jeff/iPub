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

    public function getCompose(){
        return view('compose');
    }

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
            $this->saveAsDraft($request);
            return redirect('/mailbox/compose')->with(['saved' => 'Your draft has been saved.']);
        } elseif (isset($request->send)){
            if($request->hasFile('attachment')){
                $sent = @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                    $message->from(Auth::user()->email, Auth::user()->name);
                    $message->to($request->recipient);
                    $message->attach($request->attachment->getRealPath());
                    $message->subject('iPub, a mail from an iPub account user');
                });

                if(!$sent){
                    $this->saveAsDraft($request);
                    return redirect('/mailbox/compose')->with(['saved' => 'Unable to send mail. Saved as draft.']);
                }
            } else {
                $sent = @Mail::send('emails.mail', ['subject' => $request->subject, 'body' => $request->body], function($message) use ($request){
                    $message->from(Auth::user()->email, Auth::user()->name);
                    $message->to($request->recipient);
                    $message->subject('iPub, a mail from an iPub account user');
                });

                if(!$sent){
                    $this->saveAsDraft($request);
                    return redirect('/mailbox/compose')->with(['saved' => 'Unable to send mail. Saved as draft.']);
                }
            }

            return redirect('/mailbox/compose')->with(['sent' => 'Your mail has been sent.']);
        }
    }

    private function saveAsDraft(Request $request){
        if($request->hasFile('attachment')){
            $path = Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
            $filename = $request->attachment->getClientOriginalName();

            $mail_item = new MailItem();
            $mail_item->user_id = $request->user_id;
            $mail_item->sender = $request->sender;
            $mail_item->recipient = $request->recipient;
            $mail_item->body = $request->body;
            $mail_item->attachment = $filename;
            $mail_item->status = 0;
            $mail_item->is_draft = 1;
            $mail_item->save();

            Storage::disk('public')->put($path.$filename, File::get($request->attachment));
        } else {
            $request->is_draft = 1;
            MailItem::create($request->all());
        }
    }

    public function inbox(){
        return view('inbox');
    }

    public function sent(){
        return view('sent');
    }

    public function drafts(){
        return view('drafts');
    }

    public function readmail($category, $id){
        return view('readmail', ['category' => $category]);
    }
}
