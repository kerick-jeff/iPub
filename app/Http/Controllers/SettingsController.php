<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Storage;
use File;
use Validator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class SettingsController extends Controller
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

    public function settings(){
        return view('settings');
    }

    // set or update an authenticated user's profile picture
    public function setProfilePicture(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2000',
        ], ['profile_picture.required' => 'No picture was selected']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($request->hasFile('profile_picture')){
            $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
            $old = $path."/".Auth::user()->profile_picture;
            $picture = $request->profile_picture;
            $filename = $picture->getClientOriginalName();
            Image::make($picture)->resize(300, 300)->save($path."/".$filename);
            User::where('id', Auth::user()->id)
                ->update(['profile_picture' => $filename]);
            if(!empty($old)){
                File::Delete($old);
            }
        }
        return redirect('/settings');
    }

    public function setPhoneNumber(Request $request){
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
        ], ['phone_number.required' => 'Please enter your phone number']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        return $request->phone_number;
    }

}
