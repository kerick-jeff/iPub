<?php

namespace App;
 
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'profile_picture',
        'description',
        'country',
        'country_code',
        'geo_longitude',
        'geo_latitude',
        'stars'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * a user has 0 or more links (contact links) i.e website url, additional email, phone number, fax and other contact links, place address
    * @return Link
    */
    public function links(){
        return hasMany('App\Link');
    }

    /**
    * a user has 0 or more notifications
    * @return Notification
    */
    public function notifications(){
        return hasMany('App\Notification')
    }

    /**
    * a user makes 0 or more pubs
    * @return Pub
    */
    public function pubs(){
        return hasMany('App\Pub');
    }

    /**
    * a user makes 0 or more subscriptions i.e video_pub_subscription, continous_pub_subscription, priorit_zone_subscription
    * @return Subscription
    */
    public function subscriptions(){
        return hasMany('App\Subscription');
    }
}
