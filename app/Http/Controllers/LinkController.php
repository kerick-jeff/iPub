<?php

namespace App\Http\Controllers;

use App\User;
use App\Link;
use Illuminate\Http\Request;
use App\Http\Requests;

class LinkController extends Controller
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
     * add a link/contact for an authenticated user
     * @param Request $request
     */
    public function add(Request $request){
        Link::create($request->all());
        $links = User::find($request->user_id)->links;
        return view('account', ['links' => $links]);
    }

    /**
     * remove the selected link/contact
     */
    public function remove($id){

    }
}
