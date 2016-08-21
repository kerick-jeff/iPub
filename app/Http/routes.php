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
/*test routes*/
Route::get('/photos', function(){
    $photos = ['8577innovation-is-great-British-Embassy.jpg', 'AZ-home-rebrand_02.jpg', 'IMAG0787.jpg', 'rain.jpeg'];
    return view('photos', ['photos' => $photos]);
});
Route::get('/photo/{name}', function($name){
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
    return Image::make($path."/".$name)->response("jpg");
});
Route::get('/geo', function(){
    return view('geo');
});
// end test routes

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

/* SettingsController routes */
Route::get('/settings', 'SettingsController@settings');

Route::post('/settings/profile-picture', 'SettingsController@setProfilePicture');

Route::post('/settings/phone-number', 'SettingsController@setPhoneNumber');

Route::post('/settings/security', 'SettingsController@setSecurity');

Route::post('/settings/description', 'SettingsController@setDescription');

Route::post('/settings/location', 'SettingsController@setLocation');

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

/* PubsController routes */
Route::get('/pubs', 'PubsController@pubs');
