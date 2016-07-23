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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/* EmailController routes */
Route::get('/register/verify/{email}/{code}', 'EmailController@verifyRegistrationEmail');

Route::get('/resend/{email}/{name}', 'EmailController@resendVerificationEmail');

/* HomeController routes */
Route::get('/account', 'HomeController@account');

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
Route::delete('/link/remove/{id}', 'LinkController@remove');
