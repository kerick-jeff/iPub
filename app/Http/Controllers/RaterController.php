<?php

namespace App\Http\Controllers;

use Mail;
use Validator;
use App\Rater;
use Illuminate\Http\Request;
use App\Http\Requests;

class RaterController extends Controller
{
    /**
      * Register a new rater
      * @param $email
      * @return
     */
    public function register($email) {
        if(count(Rater::where('email', $email)->first()) > 0) {
            return redirect('/pubs')->with('raterRegError', 'Sorry, this email is already taken');
        }

        $newRater = new Rater();
        $newRater->email = $email;
        $newRater->rating_mode = false;
        $newRater->confirmed = false;
        if($newRater->save()){
            $this->sendConfirmationLink($email, false);
        }

        return redirect('/pubs')->with('raterRegSuccess', "Your Rater account has been successfully registered. A confirmation link has been sent to your email. &nbsp;&nbsp;<a href = '/rating-mode/resend-confirmation-link/".$email."' class = 'btn btn-info' style = 'text-decoration: none'>Resend</a>");
    }

    /**
     * Send confirmation link
     * @param $email
     * @return void
     */
     public function sendConfirmationLink($email) {
         @Mail::send('emails.confirm_rater', ['email' => $email], function($message) use ($email) {
             $message->from('frukerickjeff@gmail.com', 'iPub');
             $message->to($email)
                     ->subject('iPub. Verify your email address');
         });

         return redirect('/pubs')->with('raterRegSuccess', "A confirmation link has been resent to your email. &nbsp;&nbsp;<a href = '/rating-mode/resend-confirmation-link/".$email."' class = 'btn btn-info' style = 'text-decoration: none'>Resend</a>");
     }

    /**
     * Enters a rater into Rating mode
     * @param $email
     * @return
     */
    public function enter(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        $rater = Rater::where('email', $request->email)->first();

        if(count($rater) > 0) {
            if($rater->confirmed) { // Enter Rating Mode
                $rater->update(['rating_mode' => 1]);
                $request->session()->put('rater', $rater->email);
                return redirect('/pubs');
            } else { // Rater account not confirmed
                return redirect('/pubs')->with('raterNotConfirmed', "This Rater account has not been confirmed. A confirmation link was sent to the email used in creating it. &nbsp;&nbsp; <a href = '/rating-mode/resend-confirmation-link/".$request->email."' class = 'btn btn-primary' style = 'text-decoration: none'>Resend</a>");
            }
        } else { // Non existent Rater account
            return redirect('/pubs')->with('raterNotFound', "The Rater account you are trying to enter does not exist. &nbsp;&nbsp;<a href = '/rating-mode/register/".$request->email."' class = 'btn btn-info' style = 'text-decoration: none'>Try creating one</a>");
        }
    }

    /**
     * Exits a rater from Rating mode
     * @param $email
     * @return
     */
    public function exit(Request $request, $email) {
        $rater = Rater::where('email', $email)->first();
        if(count($rater) > 0) {
            $rater->update(['rating_mode' => 0]);
            if($request->session()->has('rater')) {
                $request->session()->forget('rater');
            }
        }

        return redirect('/pubs');
    }

    /**
     * Confirm new Rater account
     * @param $email
     * @return
     */
    public function confirm($email) {
        $rater = Rater::where('email', $email)->first();
        if(count($rater) > 0 && !$rater->confirmed) {
            $rater->update(['confirmed' => 1]);
            return redirect('/pubs')->with('raterConfirmed', 'Your Rater account has been confirmed. You can now enter into Rating Mode.');
        } else {
            return redirect('/pubs');
        }
    }
}
