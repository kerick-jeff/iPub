<?php

namespace App\Http\Controllers;

use App\User;
use Mail;
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
        if(!empty($user) && $user->confirmed == 0){
            $user->update(['confirmation_code' => $code, 'confirmed' => 1]);

            // create a directory for holding content for each user upon verification
            Storage::makeDirectory('public/'.$user->id."-".$user->name);

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

      $send = Mail::send('auth.emails.verify', ['confirmation_code' => $confirmation_code, 'email' => $email], function($message) use ($name, $email) {
          $message->from('frukerickjeff@gmail.com', 'iPub');
          $message->to($email, $name)
                  ->subject('Verify your email address');
      });
      return redirect('/login')->with(['info' => 'Please verify your email. Click the link in the email sent to you', 'email' => $email, 'name' => $name]);
    }
}
