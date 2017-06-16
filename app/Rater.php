<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rater extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'email',
        'rating_mode',
        'confirmed'
    ];

    /**
    * a rater can rate 0 or more pubs
    * @return \App\Pub
    */
    public function pubs(){
        return $this->belongsToMany('App\Pub');
    }
}
