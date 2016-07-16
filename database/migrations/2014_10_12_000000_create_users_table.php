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
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique;
            $table->string('phone_number');
            $table->bcrypt('password', 60);
            $table->string('profile_picture', 255);
            $table->text('description');
            $table->string('country');
            $table->string('country_code');
            $table->string('geo_longitude', 3);
            $table->string('geo_latitude', 3);
            $table->enum('stars', [1, 2, 3, 4, 5])->default(1);
            $table->timestamps();
        });
    }
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'profile_picture',
        'description',
        'country',
        'country_code',
        'geo_longitude',
        'geo_latitude',
        'stars'
    ];
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
