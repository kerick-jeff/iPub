<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Link;
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

        // get an authenticated user's followers
        $followers = Auth::user()->followers()->get();

        //determine account status
        $status = 40;
        if(Auth::user()->profile_picture){
            $status += 15;
        } if(Auth::user()->geo_longitude && Auth::user()->geo_latitude) {
            $status += 15;
        } if(Auth::user()->description) {
            $status += 15;
        } if(Auth::user()->phone_number){
            $status += 15;
        }

        return view('account', ['links' => $links, 'followers' => $followers, 'status' => $status]);
    }
}
