<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailItem extends Model
{
    /**
     *  the attributes that are mass assignable
     * @var array
     */
     protected $fillable = [
          'user_id',
          'sender',
          'recipient',
          'subject',
          'body',
          'attachment',
          'status', // indicates that an incoming message has been read by the iPub account user
          'is_sent', // indicates that the iPub account user's mail has been sent
          'is_draft' // indicates that a mail has been saved as a draft
     ];

     /**
      * the name of the table in the database in which MailItem objects will be stored
      * @var String
      */
     protected $table = 'mails';

     /**
     * 0 or more mails are received by a user
     * @return User
     */
     public function user(){
         return $this->belongsTo('App\User');
     }
}
