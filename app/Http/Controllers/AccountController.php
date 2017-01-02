<?php

namespace App\Http\Controllers;

use App\User;
use App\Link;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

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

        // get an authenticated user's followers
        $followers = Auth::user()->followers()->get();

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
        } if(Auth::user()->geo_longitude && Auth::user()->geo_latitude) {
            $status += 15;
        } if(Auth::user()->description) {
            $status += 15;
        } if(Auth::user()->phone_number){
            $status += 15;
        } if(Auth::user()->tour_video){
            $status += 15;
        }

        return view('account', ['links' => $links, 'followers' => $followers, 'status' => $status, 'geoLocations' => $geoLocations, 'locations' => $locations]);
    }
}
