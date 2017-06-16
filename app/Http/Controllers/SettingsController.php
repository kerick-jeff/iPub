<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Storage;
use File;
use Validator;
use App\GeoLocation;
use App\User;
use App\Product;
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

    public function index(){
        return view('settings');
    }

    /**
     * set or update an authenticated user's profile picture
     * @param Request $request
     */
    public function setProfilePicture(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|max:255',
        ], ['profile_picture.required' => 'No picture was selected', 'profile_picture.image' => 'Please select a picture', 'profile_picture.size' => 'The picture size must not be greater than 5 MB', 'profile_picture.max' => 'The size of the picture should not be more than ...']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($request->hasFile('profile_picture')){
            $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name."/";
            $old = $path."/".Auth::user()->profile_picture;
            $picture = $request->profile_picture;
            $filename = $picture->getClientOriginalName();
            // Create user account directory if it doesn't exists
            if(!Storage::disk('public')->exists(Auth::user()->id."-".Auth::user()->name)){
                Storage::disk('public')->makeDirectory(Auth::user()->id."-".Auth::user()->name);
            }
            Image::make($picture)->resize(300, 300)->save($path.$filename);
            User::where('id', Auth::user()->id)
                ->update(['profile_picture' => $filename]);
            if(!empty($old)){
                File::Delete($old);
            }
        }

        return redirect('/settings');
    }

    /**
     * set tour video video
     * @param Request $request
     */
    public function setTourVideo(Request $request){
        $validator = Validator::make($request->all(), [
            'tour_video' => 'required|mimes:mp4,mpeg,ogg,avi,mov|max:800000',
        ], ['tour_video.required' => 'No video was selected', 'tour.mimes' => 'Please select a video', 'tour_video.max' => 'The size of the video should not exceed ...']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($request->hasFile('tour_video')){
            $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name;
            $old = $path."/".Auth::user()->tour_video;
            $filename = $request->tour_video->getClientOriginalName();
            $path = Auth::user()->id."-".Auth::user()->name."/";
            Storage::disk('public')->put($path.$filename, File::get($request->tour_video));
            User::where('id', Auth::user()->id)
                ->update(['tour_video' => $filename]);
            if(!empty($old)){
                File::Delete($old);
            }
        }

        return redirect('/settings');
    }

    /**
     * sets iPub account user's phone number
     * @param Request $request
     */
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

    /**
     * sets a new password for the iPub account user
     * @param Request $request
     */
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

    /**
     * adds a new product or service
     * @param Request $request
     */
    public function setProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ], ['name.required' => 'Please enter the name of a product/service']);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        Product::create($request->all());

        return redirect('/settings')->with('product', 'New product/service added!');
    }

    /**
     * set iPub account user's description
     * @param Request $request
     */
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

    /**
     * set iPub account user's geolocation
     * @param Request $request
     */
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

        GeoLocation::create($request->all());
        return redirect('/settings')->with('geolocation', 'New location set at latitude: '.$request->geo_latitude.", longitude: ".$request->geo_longitude);
    }
}
