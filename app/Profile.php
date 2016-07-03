<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    $fillable = ['picture', 'phone_number', 'description', 'country', 'country_code', 'geo_longitude', 'geo_latitude', 'stars'];

    /**
    * a profile is being managed and belongs to a single user
    * @return Profile
    */
    public function user(){
        return BelongsTo('App\User');
    }
}
