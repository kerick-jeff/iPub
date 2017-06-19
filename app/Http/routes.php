<?php

use App\Pub;
use App\User;
use App\PubFile;
use App\Rater;
use App\MailItem;
use App\FileMetric;
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
    $photos = ['pic1.jpg', 'pic2.jpg', 'pic3.jpg', 'pic4.jpg', 'pic5.png'];
    return view('photos', ['photos' => $photos]);
});

Route::get('/photo/{session_name()}', function($name){
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
    return Image::make($path."/".$name)->response("jpg");
});

*/
Route::get('/email', function() {
    return view('emails.invite', ['email' => 'example@email.com']);
});

Route::get('/500', function(){
    return view('errors.500');
});

Route::get('/geo', function(){
    return view('geo');
});

Route::get('/paginate', function(){
    $links = DB::table('links')->paginate(2);
    return view('paginate', ['links' => $links]);
});
Route::get('/metric/{bytes}', function($bytes){
    echo FileSizeMetric::represent($bytes);
});
// end test routes

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/* This section contains routes related to the User and its parts used in the /pubs page */
/* Get a user by its id */
Route::get('/user/{id}/{returnType?}', function($id, $returnType = null){
    $user = User::find($id);
    if($returnType == null) {
        return $user;
    } elseif ($returnType == "json") {
        return Response::json($user);
    }
});

/* Get a user's geolocations by its id */
Route::get('/user/geolocation/{userid}/{returnType?}', function($userId, $returnType = null){
    $geoLocations = User::find($userId)->geolocations()->get();

    // locations
    $locations = [];
    foreach ($geoLocations as $geoLocation) {
        $location = ['id' => $geoLocation->id, 'info' => '<strong>iPub - '.$geoLocation->user_id."</strong><br />", 'lat' => $geoLocation->geo_latitude, 'lon' => $geoLocation->geo_longitude];
        array_push($locations, $location);
    }

    if($returnType == null) {
        return $locations;
    } elseif ($returnType == "json") {
        return Response::json($locations);
    }
});

/* Get a user's links/contacts by its id */
Route::get('/user/links/{userid}/{returnType?}', function($userId, $returnType = null){
    $links = User::find($userId)->links()->get();
    if($returnType == null) {
        return $links;
    } elseif ($returnType == "json") {
        return Response::json($links);
    }
});

/* Get a user's products/services by its id */
Route::get('/user/products-services/{userid}/{returnType?}', function($userId, $returnType = null){
    $products = User::find($userId)->products()->get();
    if($returnType == null) {
        return $products;
    } elseif ($returnType == "json") {
        return Response::json($products);
    }
});

/* End of user:/pub related routes */

/* Download a file */
Route::get('/download/{filename}', function($filename){
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name."/mail_attachments/";
    return response()->download($path.$filename, 'iPub - '.$filename);
});

/* Profile Picture routes */
Route::get('/profile-picture', function(){
    if(!empty(Auth::user()->profile_picture)){
        $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
        return Image::make($path."/".Auth::user()->profile_picture)->response("jpg");
    }

    $path = Storage::disk('anonymous')->getDriver()->getAdapter()->getPathPrefix();
    return Image::make($path."anonymous.jpg")->response("jpg");
});

Route::get('/profile-picture/{user_id}/{username}/{profile_picture?}', function($user_id, $username, $profile_picture = "anonymous.jpg"){
    if(User::where('id', $user_id)->value('profile_picture')){
        $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$user_id."-".$username;
        return Image::make($path."/".$profile_picture)->response("jpg");
    }

    $path = Storage::disk('anonymous')->getDriver()->getAdapter()->getPathPrefix();
    return Image::make($path."anonymous.jpg")->response("jpg");
});

/* end of Profile Picture routes */

/* Tour Video Route */
Route::get('/tour-video', function() {
    $path = Auth::user()->id."-".Auth::user()->name."/";
    if(!empty(Auth::user()->tour_video)){
        return Storage::disk('public')->get($path.Auth::user()->tour_video);
    }

    return Storage::disk('anonymous')->get('anonymous.mp4');
});


/* UploadController routes*/
/* Photo routes */
Route::put('/photo/store', 'UploadController@storePhoto');

Route::get('/upload/photo', function(){
    $pubs = Auth::user()->pubs()->where('type', 0)->orderBy('created_at', 'desc')->paginate(6);
    return view('upload.photo', ['pubs' => $pubs]);
});

Route::get('/photo/{filename}', function( $filename ){
    $userName = User::find(Auth::user()->id)->value('name');
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".$userName.'/photo/';
    return Image::make($path . $filename)->response("jpg");
});

Route::patch('/photo/edit/{id}/{title}/{description}/{category}/{subCategory}', 'UploadController@editPhoto');

Route::delete('/photo/{id}/destroy', 'UploadController@destroyPhoto');

/* Video routes*/
Route::post('/video/store', 'UploadController@storeVideo');

Route::get('/upload/video', function(){
    $pubs = Auth::user()->pubs()->where('type', 1)->orderBy('created_at', 'desc')->paginate(6);
    return view('upload.video', ['pubs' => $pubs]);
});

Route::get('video/{filename}', function( $filename ){
    $user_id = Auth::user()->id;
    $userName = User::find($user_id)->value('name');
    $path = $user_id."-".$userName.'/video/';
    $fileContents =  Storage::disk('public')->get($path . $filename);
    $response = Response::make($fileContents, 200);
    $response->header('Content-Type', "video/mp4");
    return $response;
});

Route::patch('/video/edit/{id}/{title}/{description}/{category}/{subCategory}', 'UploadController@editVideo');

Route::delete('/video/{id}/destroy', 'UploadController@destroyVideo');

Route::post('/upload/count', 'UploadController@uploadCount');


/* SettingsController routes */
Route::get('/settings', 'SettingsController@index');

Route::post('/settings/profile-picture', 'SettingsController@setProfilePicture');

Route::post('/settings/tour-video', 'SettingsController@setTourVideo');

Route::post('/settings/phone-number', 'SettingsController@setPhoneNumber');

Route::post('/settings/security', 'SettingsController@setSecurity');

Route::post('/settings/description', 'SettingsController@setDescription');

Route::post('/settings/location', 'SettingsController@setLocation');

Route::post('/settings/product-service', 'SettingsController@setProduct');


/* EmailController routes */
Route::get('/register/verify/{email}/{code}', 'EmailController@verifyRegistrationEmail');

Route::get('/resend/{email}/{name}', 'EmailController@resendVerificationEmail');

Route::post('/invite', 'EmailController@invite', ['middleware' => 'auth']);

Route::get('/invitation/accept/{userId}/{email}', 'Ac@acceptInvitation');
/* end of EmailController routes */

/* AccountController routes */
Route::get('/account', 'AccountController@index');

Route::get('/account/raters/{returnType?}', function($returnType = null){
    $raters = DB::select('SELECT DISTINCT raters.* FROM pubs, raters, pub_rater WHERE pubs.user_id = ? AND pubs.id = pub_rater.pub_id AND raters.id = pub_rater.rater_id ORDER BY raters.created_at DESC', [Auth::user()->id]);

    $ratings = [];
    foreach ($raters as $rater) {
        $noRatings = count(DB::select('SELECT pub_rater.pub_id FROM pubs, pub_rater WHERE pubs.user_id = ? AND pubs.id = pub_rater.pub_id AND pub_rater.rater_id = ?', [Auth::user()->id, $rater->id]));
        $rating = ['rater' => $rater, 'noRatings' => $noRatings];
        array_push($ratings, $rating);
    }

    if($returnType == null) {
        return $ratings;
    } elseif ($returnType == "json") {
        return Response::json($ratings);
    }
});

Route::get('/account/inviteds/{returnType?}', function($returnType = null){
    $inviteds = Auth::user()
                    ->inviteds()
                    ->orderBy('created_at', 'desc')
                    ->get();

    if($returnType == null) {
        return $inviteds;
    } elseif ($returnType == "json") {
        return Response::json($inviteds);
    }
});
/* end of AccountController routes */

/* LinkController routes */
Route::post('/link/add', 'LinkController@add');

Route::patch('/link/edit/{id}/{link}/{caption}', 'LinkController@edit');

Route::delete('/link/delete/{id}', 'LinkController@delete');

/* GeoLocation routes */
Route::put('/geolocation/edit/{id}/{geoLatitude}/{geoLongitude}', 'GeoLocationController@edit');

Route::delete('/geolocation/delete/{id}', 'GeoLocationController@delete');

/* FollowController routes */
/* an invited visitor or guest agrees to follow an iPub user on iPub */
Route::get('/follow/agree/{user_id}/{user_name}/{email}', 'FollowController@agree');


/* PubsController routes */
Route::get('/pubs', 'PubsController@index');

Route::get('/pubs/category/{categoryName}', 'PubsController@findByCategory');

Route::get('/pubs/{username}/{userId}', 'PubsController@findByUser');

Route::get('/pubs/{id}', 'PubsController@findById');

Route::get('/pubs/rate/{id}/{returnType?}', function($id, $returnType = null) {
    if(session('rater')) {
        $pub = Pub::find($id);
        $pub->ratings += 1;
        $pub->save();

        DB::table('pub_rater')->insert(
            ['pub_id' => $pub->id, 'rater_id' => Rater::where('email', session('rater'))->value('id')]
        );

        if($returnType == null) {
            return $pub->ratings;
        } elseif ($returnType == "json") {
            return Response::json($pub->ratings);
        }
    }

    return;
});

Route::get('/pubs/unrate/{id}/{returnType?}', function($id, $returnType = null) {
    if(session('rater')) {
        $pub = Pub::find($id);
        $pub->ratings -= 1;
        $pub->save();

        DB::table('pub_rater')
          ->where('pub_id', $pub->id)
          ->where('rater_id', Rater::where('email', session('rater'))->value('id'))
          ->delete();

        if($returnType == null) {
            return $pub->ratings;
        } elseif ($returnType == "json") {
            return Response::json($pub->ratings);
        }
    }

    return;
});

Route::get('/pubs/search/{searchTerm}/{returnType?}', function($searchTerm, $returnType = null) {
    $userResults = User::where('name', 'like', $searchTerm.'%')->get();
    $titleResults = Pub::where('title', 'like', $searchTerm.'%')->get();
    $categoryResults = Pub::where('category', 'like', $searchTerm.'%')->get();

    $results = [];

    foreach ($userResults as $userResult) {
        $result = ['type' => 'user', 'content' => $userResult, 'sortBy' => $userResult->name];
        array_push($results, $result);
    }

    foreach ($titleResults as $titleResult) {
        // $associate = ['username', 'pubFile']
        $associate = [User::find($titleResult->user_id)->value('name'), $titleResult->pubFiles()->first()];
        $result = ['type' => 'title', 'content' => $titleResult, 'associate' => $associate, 'sortBy' => $titleResult->title];
        array_push($results, $result);
    }

    foreach ($categoryResults as $categoryResult) {
        $break = false;

        foreach ($results as $result) {
            if($result['type'] == 'category' && $categoryResult->category == $result['content']->category) {
                $break = true;
                break;
            }
        }

        if(!$break) {
            $result = ['type' => 'category', 'content' => $categoryResult, 'sortBy' => $categoryResult->category];
            array_push($results, $result);
        }
    }

    usort($results, 'compare');

    if($returnType == null) {
        return $results;
    } elseif ($returnType == "json") {
        return Response::json($results);
    }
});

/**
 * sort a multidimensional array of search results
 * used by GET: /pubs/search/{searchTerm}/{returnType} route
 * @param $x
 * @param $y
 * @return integer
 */
function compare($x, $y) {
    if($x['sortBy'] == $y['sortBy']) {
        return 0;
    } elseif ($x['sortBy'] < $y['sortBy']) {
        return -1;
    } else {
        return 1;
    }
}

Route::get('/pubs/display/photo/{user_id}/{username}/{filename}', function($user_id, $username, $filename) {
    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$user_id."-".$username.'/photo/';
    return Image::make($path.$filename)->response("jpg");
});

Route::get('/pubs/display/video/{user_id}/{username}/{filename}', function($user_id, $username, $filename){
    $path = $user_id."-".$username.'/video/';
    $fileContents =  Storage::disk('public')->get($path.$filename);
    $response = Response::make($fileContents, 200);
    $response->header('Content-Type', "video/mp4");
    return $response;
});


/* end of PubsController routes */

/* MailboxController routes */
Route::get('/mailbox/compose', 'MailboxController@getCompose');

Route::post('/mailbox/compose', 'MailboxController@postCompose');

Route::post('/mailbox/send/sendSaved/{category}', 'MailboxController@sendSaved');

Route::get('/mailbox/inbox', 'MailboxController@inbox');

Route::get('/mailbox/sent', 'MailboxController@sent');

Route::get('/mailbox/drafts', 'MailboxController@drafts');

Route::get('/mailbox/readmail/{category}/{id}', 'MailboxController@readMail');

//delete one or more mails when checked by the checkbox html element
Route::delete('/mailbox/deletemails/{category}/{ids}', 'MailboxController@deleteMails');

//delete a single readmail
Route::delete('/mailbox/delete/{category}/{id}', 'MailboxController@delete');

Route::post('/mailbox/forward/{category}', 'MailboxController@forward');

Route::post('/mailbox/check', 'MailboxController@check');

/* end of MailboxController routes */

/* ProductController routes */
Route::delete('/product/delete/{id}', 'ProductController@delete');

/* RaterController routes */
Route::get('/rating-mode/register/{email}', 'RaterController@register');

Route::post('/rating-mode/enter', 'RaterController@enter');

Route::get('/rating-mode/exit/{email}', 'RaterController@exit');

Route::get('/rating-mode/confirm/{email}', 'RaterController@confirm');

Route::get('/rating-mode/resend-confirmation-link/{email}', 'RaterController@sendConfirmationLink');

/* end of RaterController routes */

/* StatisticsController routes */
Route::get('/statistics', 'StatisticsController@statistics');
