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
        
        return view('account', ['links' => $links, 'followers' => $followers]);
    }
}
