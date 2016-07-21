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
    $user = User::where('email', $email)->first();
    if(!empty($user) && $user->confirmed == 0){
        $user->update(['confirmation_code' => $code, 'confirmed' => 1]);
        return redirect('/login')->with('success', 'Your email has been verified. You can now login');
    }
    return '<a href = "/register">Please register an account to activate!</a>';
});

Route::get('/resend/{email}/{name}', function($email, $name){
    // send verification email
    $confirmation_code = str_random(30);

    $send = Mail::send('auth.emails.verify', ['confirmation_code' => $confirmation_code, 'email' => $email], function($message) use ($name, $email) {
        $message->from('frukerickjeff@gmail.com', 'iPub');
        $message->to($email, $name)
                ->subject('Verify your email address');
    });
    return redirect('/login')->with(['info' => 'Please verify your email. Click the link in the email sent to you', 'email' => $email, 'name' => $name]);
});

Route::get('/account', 'HomeController@account');

Route::get('/upload/photo',function(){
    return view('uploads.photo');
});

Route::post('/photo/store', 'Upload\UploadController@storePhoto');

Route::get('/upload/video', function(){
    return view('uploads.video');
});

Route::post('/video/store', 'Upload\UploadController@storeVideo');
