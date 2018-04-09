<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Link;
use App\Invited;
use App\Rater;
use App\Http\Requests;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // links/contacts of authenticated user
        $links = Auth::user()->links;

        // products/services offered by the authenticated User
        $products = Auth::user()->products;

        // get an authenticated user's raters
        $noRaters = count(DB::select('SELECT DISTINCT raters.id FROM pubs, raters, pub_rater WHERE pubs.user_id = ? AND pubs.id = pub_rater.pub_id AND (raters.id = pub_rater.rater_id OR raters.id = pub_rater.liker_id)', [Auth::user()->id]));
        $raters = DB::select('SELECT DISTINCT raters.* FROM pubs, raters, pub_rater WHERE pubs.user_id = ? AND pubs.id = pub_rater.pub_id AND (raters.id = pub_rater.rater_id OR raters.id = pub_rater.liker_id) ORDER BY created_at DESC LIMIT 1', [Auth::user()->id]);

        $ratings = [];
        foreach ($raters as $rater) {
            $noRatings = count(DB::select('SELECT pub_rater.pub_id FROM pubs, pub_rater WHERE pubs.user_id = ? AND pubs.id = pub_rater.pub_id AND pub_rater.rater_id = ?', [Auth::user()->id, $rater->id]));
            $noLikes = count(DB::select('SELECT pub_rater.pub_id FROM pubs, pub_rater WHERE pubs.user_id = ? AND pubs.id = pub_rater.pub_id AND pub_rater.liker_id = ?', [Auth::user()->id, $rater->id]));
            $rating = ['rater' => $rater, 'noRatings' => $noRatings, 'noLikes' => $noLikes];
            array_push($ratings, $rating);
        }

        // get people invited by an authenticated user
        $noInviteds = count(Auth::user()->inviteds()->get());
        $inviteds = Auth::user()
                        ->inviteds()
                        ->orderBy('created_at', 'desc')
                        ->take(2)
                        ->get();

        // geolocations
        $geoLocations = Auth::user()->geoLocations()->get();

        // locations
        $locations = [];
        foreach ($geoLocations as $geoLocation) {
            $location = ['id' => $geoLocation->id, 'info' => '<strong>iPub - '.$geoLocation->user_id."</strong><br />", 'lat' => $geoLocation->geo_latitude, 'lon' => $geoLocation->geo_longitude];
            array_push($locations, $location);
        }

        //determine account status
        $status = 25;
        if(Auth::user()->profile_picture){
            $status += 15;
        } if(count($geoLocations) > 0) {
            $status += 15;
        } if(Auth::user()->description) {
            $status += 15;
        } if(Auth::user()->phone_number){
            $status += 15;
        } if(count($products) > 0){
            $status += 15;
        }

        $labels = ['primary', 'success', 'info', 'warning', 'danger'];

        return view('account', ['links' => $links, 'products' => $products, 'ratings' => $ratings, 'noRaters' => $noRaters, 'inviteds' => $inviteds, 'noInviteds' => $noInviteds, 'status' => $status, 'geoLocations' => $geoLocations, 'locations' => $locations, 'labels' => $labels]);
    }

    /**
     * handles acceptance of an invitation
     * @param $userId
     * @param $email
     */
    public function acceptInvitation($userId, $email) {
        Invited::where('user_id', $userId)
                ->where('email', $email)
                ->update(['accepted' => 1]);

        $rater = Rater::where('email', $email)->first();

        if(!$rater) {
            Rater::create(['email' => $email, 'rating_mode' => 0, 'confirmed' => 1]);
        } else {
            if($rater->confirmed && $rater->rating_mode) {
                return redirect('/pubs')->with('success', 'Ok, that\'s good!');
            }
        }

        return redirect('/pubs')->with('success', 'Ok, that\'s good! Now enter Rating Mode to be able to rate pubs');
    }
}
