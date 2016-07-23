<?php
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

Route::get('/storage', function(){
    $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
    return view('storage', ['path' => $storagePath]);
});

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/* EmailController routes */
Route::get('/register/verify/{email}/{code}', 'EmailController@verifyRegistrationEmail');

Route::get('/resend/{email}/{name}', 'EmailController@resendVerificationEmail');

Route::post('/invite', 'EmailController@invite', ['middleware' => 'auth']);

/* AccountController routes */
Route::get('/account', 'AccountController@index');

/* LinkController routes */
Route::post('/link/add', 'LinkController@add');

Route::patch('/link/edit/{id}/{link}/{caption}', 'LinkController@edit');

Route::delete('/link/delete/{id}', 'LinkController@delete');

/* FollowController routes */
// an invited visitor or guest agrees to follow an iPub user on iPub
Route::get('/follow/agree/{user_id}/{user_name}/{email}', 'FollowController@agree');
