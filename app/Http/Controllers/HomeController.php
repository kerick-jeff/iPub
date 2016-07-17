<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
<<<<<<< HEAD
        return view('layout.master');
=======
        return view('account');
>>>>>>> 177e3125edb530f0bec8de982e405f09c8bdb16a
    }
}
