<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'user_id',
        'filename',
        'type',
        'size',
        'extension'
    ];
    
    /**
     * a profile picture is owned by a single user
     * @return \App\User
     */
    public function user(){
        $this->belongsTo('App\User');
    }
}
