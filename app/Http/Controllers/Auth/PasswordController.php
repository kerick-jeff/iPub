<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware());
    }

    public function send(Request $request){
        $email = $request->input('email');
        $content = 'App\User::find($email)';

        Mail::send('auth.passwords.email', ['email' => $content], function ($man)
        {

            $man->from('tigrodrige@gmail.com', 'Tayong Rodrige')

                ->to('trodrige@yahoo.com');

        });

        return response()->json(['message' => 'Request completed']);
    }

}
