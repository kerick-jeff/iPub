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
             $table->string('profile_picture', 255);
             $table->text('description');
             $table->string('country');
             $table->char('country_code', 6);
             $table->string('geo_longitude', 3);
             $table->string('geo_latitude', 3);
             $table->enum('stars', [1, 2, 3, 4, 5])->default(1);
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
