<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Storage;
use Validator; 
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class SettingsController extends Controller
{
    protected $path;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
    }

    public function settings(){
        return view('settings');
    }

    // set or update an authenticated user's profile picture
    public function setProfilePicture(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required',
        ], ['profile_picture.required' => 'No picture was selected']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($request->hasFile('profile_picture')){
            $picture = $request->profile_picture;
            $filename = $picture->getClientOriginalName();
            Image::make($picture)->resize(300, 300)->save($this->path."/".$filename);
            User::where('id', Auth::user()->id)
                ->update(['profile_picture' => $filename]);
        }
        return redirect('/settings');
    }

}
