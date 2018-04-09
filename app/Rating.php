<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'user_id',
        'rate',
        'level',
        'total'
    ];

    /**
    * a user's rating
    * @return \App\User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
