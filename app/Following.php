<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'follower_id',
        'user_id',
    ];

    /**
     * 0 or more followings belong to a follower_id
     * @return \App\Follower
     */
     public function follower(){
        return $this->belongsTo('App\Follower');
     }
}
