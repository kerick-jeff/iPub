<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('users', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name', 255);
             $table->string('email', 255)->unique();
             $table->string('phone_number');
             $table->string('password', 60);
             $table->enum('type', ['individual', 'business', 'company', 'organisation', 'ngo'])->default('individual');
             $table->string('profile_picture', 255);
             $table->string('tour_video', 255);
             $table->text('description');
             $table->string('country');
             $table->char('dial_code', 6);
             $table->boolean('confirmed')->default(0); // unconfirmed user account(false), confirmed user account(true)
             $table->string('confirmation_code', 30)->nullable();
             $table->rememberToken();
             $table->timestamps();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('users');
     }
}
