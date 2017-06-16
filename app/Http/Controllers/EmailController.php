<?php

namespace App\Http\Controllers;

use App\User;
use App\Link;
use App\Invited;
use Mail;
use Auth;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests;

class EmailController extends Controller
{
    /**
    * verify the registered user's email, to give access to the user account
    * @param String $email
    * @param String $code
    */
    public function verifyRegistrationEmail($email, $code) {
        $user = User::where('email', $email)->first();
        if(count($user) > 0 && $user->confirmed == 0){
            $user->update(['confirmation_code' => $code, 'confirmed' => 1]);

            //insert email the first link/contact of the user
            $link = new Link();
            $link->user_id = $user->id;
            $link->link = $user->email;
            $link->caption = "email";
            $link->save();

            // create a directory for holding content for each user upon verification
            Storage::disk('public')->makeDirectory($user->id."-".$user->name);

            return redirect('/login')->with('success', 'Your email has been verified. You can now login');
        }

        $message = "This email has already been verified.<br /><a href = '/'>Please return back</a>";
        return view('bounce', ['message' => $message]);
    }

    /**
    * resend the verification email to the newly registered user
    * @param String $email
    * @param String $name
    */
    public function resendVerificationEmail($email, $name){
      // resend verification email
      $confirmation_code = str_random(30);

      @Mail::send('auth.emails.verify', ['confirmation_code' => $confirmation_code, 'email' => $email], function($message) use ($name, $email) {
          $message->from('frukerickjeff@gmail.com', 'iPub');
          $message->to($email, $name)
                  ->subject('iPub. Verify your email address');
      });
      return redirect('/login')->with(['info' => 'Please verify your email. Click the link in the email sent to you', 'email' => $email, 'name' => $name]);
    }

    /**
     * an authenticated user can invite someone through email to follow his pubs on iPub
     * @param Request $request
     */
    public function invite(Request $request){
        $email = $request->email;
        $send = @Mail::send('emails.invite', ['email' => $email], function($message) use ($email){
            $message->from('frukerickjeff@gmail.com', 'iPub');
            $message->to($email)
                    ->subject('iPub. Invitation to Rate');
        });

        if($send){
            Invited::create(['user_id' => Auth::user()->id, 'email' => $email, 'accepted' => 0]);
            return redirect('/account')->with('success', 'Your invitation has been successfully sent to '.$email);
        } else {
            return redirect('/account')->with('failure', 'Sending your invitation to'.$email." failed");
        }
    }
}
