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
        'pub_id',
        'filename',
        'type',
        'size',
        'extension'
    ];

    /**
     * The model should not be timestamped
     * @var bool
     */
    public $timestamps = false;

    /**
     * a pub file belongs to a pub
     * @return \App\Pub
     */
    public function pub(){
        return $this->belongsTo('App\Pub');
    }

}
