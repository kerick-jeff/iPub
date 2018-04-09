<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PubRater extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'pub_rater';

    /**
     * the attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
        'pub_id',
        'liker_id',
        'rater_id'
    ];
}
