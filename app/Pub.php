<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = ['caption', 'category', 'sub_category', 'priority', 'views', 'ratings'];

    /**
    * a pub has a single pub multimedia file i.e photo or video file but not audio
    * @return PubFile
    */
    public function pubfile(){
        return hasOne('App\PubFile');
    }
}
