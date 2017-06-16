<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub extends Model
{
    /**
    * the attributes that are mass assignable
    * @var array
    */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'category',
        'sub_category',
        'priority',
        'views',
        'ratings'
    ];

    /**
     * The list of all pub categories that are scaled on iPub
     * @var array
     */
    private static $categories = [
      'Electronics',
      'Agriculture',
      'Auto',
      'Catering Services',
      'Construction',
      'Daily Deals',
      'Education/Learning',
      'Electronics/Technology',
      'Entrepreneurs/Startups',
      'Fashion',
      'Finance',
      'Health/Fitness',
      'Home Services',
      'Household',
      'Labour/Skills',
      'Sports',
      'Transport'
    ];

    /**
     * returns the list of categories scaled on iPub
     * @return array
     */
    public static function getCategories() {
        return static::$categories;
    }

    /**
    * a pub has one or more pub files
    * @return \App\PubFile
    */
    public function pubFiles(){
        return $this->hasMany('App\PubFile');
    }

    /**
    * 0 or more pubs can be made by a user
    * @return \App\User
    */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
    * a pub can be rated by 0 or more raters
    * @return \App\Rater
    */
    public function raters(){
        return $this->belongsToMany('App\Rater');
    }
}
