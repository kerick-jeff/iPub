<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invited extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'user_id',
        'email',
        'accepted'
    ];

    /**
    * 0 or more persons are invited by a user
    * @return \App\User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
