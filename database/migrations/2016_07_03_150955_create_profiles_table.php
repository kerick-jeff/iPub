<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('picture', 255);
            $table->string('phone_number');
            $table->text('description');
            $table->string('country');
            $table->char('country_code', 6);
            $table->integer('geo_longitude', 3);
            $table->integer('geo_latitude', 3);
            $table->integer('stars', [1, 2, 3, 4, 5])->default(1);
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
