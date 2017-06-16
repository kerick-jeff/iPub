<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'user_id',
        'name'
    ];

    /**
    * 0 or more products/services are offered by the user
    * @return User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
