<?php

namespace App\Http\Controllers;

use App\GeoLocation;
use Illuminate\Http\Request;
use App\Http\Requests;

class GeoLocationController extends Controller
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
     * edit the selected geolocation
     * @param Integer $id
     * @param String $geoLatitude
     * @param String $geoLongitude
     */
    public function edit($id, $geoLatitude, $geoLongitude){
        $geolocation = GeoLocation::find($id);
        $geolocation->geo_latitude = $geoLatitude;
        $geolocation->geo_longitude = $geoLongitude;
        $geolocation->save();

        return Response::json($geolocation);
    }

    /**
     * delete the selected geolocation
     * @param Integer $id
     */
    public function delete($id) {
        GeoLocation::destroy($id);
    }

}
