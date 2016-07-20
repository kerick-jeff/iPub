<?php

use App\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/register/verify/{email}/{code}', function($email, $code){
    $user = User::where('email', $email);
    if(!empty($user) && empty($user->confirmation_code)){
        $user->update(['confirmation_code' => $code, 'confirmed' => 1]);
        return redirect('/account');
    }
    return 'Please register an account to activate!';
});

Route::get('/resend/{email}/{name}', function($email, $name){
    // send verification email
    $confirmation_code = str_random(30);

    $send = Mail::send('auth.emails.verify', ['confirmation_code' => $confirmation_code, 'email' => $email], function($message) use ($name, $email) {
        $message->from('frukerickjeff@gmail.com', 'iPub');
        $message->to($email, $name)
                ->subject('Verify your email address');
    });
    return redirect('/login')->with(['status' => 'Please verify your email. Click the link in the email sent to you', 'email' => $email, 'name' => $name]);
});

Route::get('/account', 'HomeController@account');
