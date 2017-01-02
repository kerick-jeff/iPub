<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoLocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'geo_longitude',
        'geo_latitude'
    ];

    /**
    * 0 or more geolocations locate a user
    * @return User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
