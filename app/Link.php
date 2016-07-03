<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = ['link', 'caption'];

    /**
    * 0 or more links belongs to a user
    * @return User
    */
    public function user(){
        return BelongsTo('App\User');
    }
}
