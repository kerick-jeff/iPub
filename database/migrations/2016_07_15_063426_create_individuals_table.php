<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone_number');
            $table->string('password', 60);
            $table->string('profile_picture', 255);
            $table->text('description');
            $table->string('country');
            $table->char('country_code', 6);
            $table->integer('geo_longitude', 3);
            $table->integer('geo_latitude', 3);
            $table->integer('stars', [1, 2, 3, 4, 5])->default(1);
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
        Schema::drop('individuals');
    }
}
