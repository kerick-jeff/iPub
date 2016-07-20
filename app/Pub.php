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
        'title',
        'description',
        'type',
        'filename',
        'category',
        'sub_category',
        'priority',
        'views',
        'ratings'
    ];

    /**
    * 0 or more pubs can be made by a user
    * @return User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
