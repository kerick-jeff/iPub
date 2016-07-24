<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PubFile extends Model
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
     * a pub file belongs to a pub
     * @return \App\Pub
     */
    public function pub(){
        return $this->belongsTo('App\Pub');
    }

}
