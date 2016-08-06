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
Route::get('/photos', function(){
    $photos = ['8577innovation-is-great-British-Embassy.jpg', 'AZ-home-rebrand_02.jpg', 'IMAG0787.jpg', 'rain.jpeg'];
    return view('photos', ['photos' => $photos]);
});
Route::get('/photo/{name}', function($name){
  $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name.'/photo';
  return Image::make($path."/".$name)->response("jpg");
});

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/* Profile Picture route */
Route::get('/profilePicture', function(){
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
    if(!empty(Auth::user()->profile_picture)){
        return Image::make($path."/".Auth::user()->profile_picture)->response("jpg");
    }

    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
    return Image::make($path."prayer.jpg")->response("jpg");
});

/* UploadController routes*/
Route::get('/upload/photo', 'UploadController@showPhoto');
Route::get('/upload/video', function(){
    return view('upload.video');
});
Route::put('/photo/store', 'UploadController@storePhoto');
Route::put('/video/store', 'UploadController@storeVideo');
Route::patch('/photo/edit', 'UploadController@editPhoto');
Route::patch('/video/edit', 'UploadController@editVideo');
Route::delete('/photo/delete', 'UploadController@deletePhoto');
Route::delete('/video/delete', 'UploadController@deleteVideo');

/* SettingsController routes */
Route::get('/settings', 'SettingsController@settings');

Route::post('/settings/profile-picture', 'SettingsController@setProfilePicture');

Route::post('/settings/phone-number', 'SettingsController@setPhoneNumber');

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
