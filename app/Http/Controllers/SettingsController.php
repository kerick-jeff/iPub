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
            'profile_picture' => 'required|image|max:255',
        ], ['profile_picture.required' => 'No picture was selected', 'profile_picture.image' => 'Please select a picture', 'profile_picture.size' => 'The picture size must not be greater than 5 MB', 'profile_picture.max' => 'The caption of the selected picture should not be more than 255 characters']);

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
            'dial_code' => 'required|max:6',
        ], ['phone_number.required' => 'Please enter your phone number']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        User::where('id', Auth::user()->id)
            ->update(['phone_number' => $request->phone_number, 'dial_code' => $request->dial_code]);

        return redirect('/settings');
    }

    public function setSecurity(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        User::where('id', Auth::user()->id)
            ->update(['password' => bcrypt($request->password)]);

        return redirect('/settings');
    }

    public function setDescription(Request $request){
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ], ['description.required' => 'Please provide a brief description']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        User::where('id', Auth::user()->id)
            ->update(['description' => $request->description]);

        return redirect('/settings');
    }

    public function setLocation(Request $request){
        $validator = Validator::make($request->all(), [
            'geo_longitude' => 'required',
            'geo_latitude' => 'required',
        ], ['required.geo_longitude' => 'Please set the longitude of your location', 'geo_latitude.required' => 'Please set the latitude of your location']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        User::where('id', Auth::user()->id)
            ->update(['geo_latitude' => $request->geo_latitude, 'geo_longitude' => $request->geo_longitude]);

        return redirect('/settings');
    }
}
