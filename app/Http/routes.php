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
Route::get('images/{filename}', function ($filename)
{
    return Image::make(storage_path() . '/app/public/2-Trodrige/photo/' . $filename)->response();
});

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

/* UploadController routes */

/* Photo routes */
Route::get('/upload/photo','Upload\UploadController@showPhoto');

Route::post('/photo/store', 'Upload\UploadController@storePhoto');
Route::get('/photo/edit/{photo_id}', 'Upload\UploadController@editPhoto');
Route::get('/photo/delete/{photo_id}', 'Upload\UploadController@deletePhoto');

/* Video routes */
Route::get('/upload/video', function(){
    return view('uploads.video');
});
Route::post('/video/store', 'Upload\UploadController@storeVideo');

/* LinkController routes */
Route::post('/link/add', 'LinkController@add');

Route::patch('/link/edit/{id}/{link}/{caption}', 'LinkController@edit');

Route::delete('/link/delete/{id}', 'LinkController@delete');

/* FollowController routes */
// an invited visitor or guest agrees to follow an iPub user on iPub
Route::get('/follow/agree/{user_id}/{user_name}/{email}', 'FollowController@agree');
