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
        $links = User::find(Auth::user()->id)->links;
        return view('account', ['links' => $links]);
    }
}
