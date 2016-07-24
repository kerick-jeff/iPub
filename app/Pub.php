<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'category',
        'sub_category',
        'priority',
        'views',
        'ratings'
    ];

    /**
    * a pub has one or more pub files
    * @return \App\PubFile
    */
    public function pubFiles(){
        return $this->hasMany('App\PubFile');
    }

    /**
    * 0 or more pubs can be made by a user
    * @return \App\User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
