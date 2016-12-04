<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Notification extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'user_id',
        'body',
        'status',
        'on_board'
    ];

    /**
    * 0 or more notifications are received a user
    * @return User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
