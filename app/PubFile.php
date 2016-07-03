<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PubFile extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = ['name', 'size', 'type'];

    /**
    * a pubfile belongs to a single pub record
    * @return Pub
    */
    public function pub(){
        BelongsTo('App\Pub');
    }
}
