<?php

use App\User;
use App\Pub;
use App\PubFile;
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
/*test routes

Route::get('/photos', function(){
    $photos = ['ttt.png', 'dullman.jpg', 'land1.jpg', 'pig.jpg'];
    return view('photos', ['photos' => $photos]);
});

Route::get('/photo/{session_name()}', function($name){
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
    return Image::make($path."/".$name)->response("jpg");
});

*/

Route::get('/geo', function(){
    return view('geo');
});

Route::get('/paginate', function(){
    $links = DB::table('links')->paginate(2);
    return view('paginate', ['links' => $links]);
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
    return Image::make($path."anonymous.jpg")->response("jpg");
});

/* UploadController routes*/

Route::put('/photo/store', 'UploadController@storePhoto');
Route::get('/upload/photo', function(){
    $pubs = Auth::user()->pubs()->orderBy('created_at', 'desc')->paginate(6);
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name.'/photo';

    return view('upload.photo', ['pubs' => $pubs]);
});
Route::get('photo/{filename}', function( $filename ){
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name.'/photo';
    return Image::make($path."/".$filename)->response("jpg");
});
Route::patch('/photo/edit/{id}/{title}/{description}/{category}/{subCategory}', 'UploadController@editPhoto');
Route::delete('/photo/{id}/destroy', 'UploadController@destroyPhoto');







Route::get('/video/store', 'UploadController@storeVideo');
Route::get('/upload/video', function(){
    return view('upload.video');
});

Route::patch('/video/edit/{id}', 'UploadController@editVideo');
Route::delete('/video/{id}/destroy', 'UploadController@destroyVideo'); 







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

/* MailboxController */
Route::get('/mailbox/compose', 'MailboxController@getCompose');

Route::post('/mailbox/compose', 'MailboxController@postCompose');

Route::get('/mailbox/inbox', 'MailboxController@inbox');

Route::get('/mailbox/sent', 'MailboxController@sent');

Route::get('/mailbox/drafts', 'MailboxController@drafts');

Route::get('/mailbox/readmail/{category}/{id}', 'MailboxController@readMail');
