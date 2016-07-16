<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array;
    */
    protected $fillable = [
        'type',
        'amount',
        'start_date',
        'end_date'
    ];

    /**
    * 0 or more subscriptions are made by a single user
    * @return User
    */
    public function user(){
        return $this->BelongsTo('App\User');
    }
}
