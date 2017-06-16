<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PubRater extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_rater', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pub_id')->unsigned();
            $table->integer('rater_id')->unsigned();
            $table->foreign('pub_id')
                  ->references('id')->on('pubs')
                  ->onDelete('cascade');
            $table->foreign('rater_id')
                  ->references('id')->on('raters')
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
        Schema::drop('pub_rater');
    }
}
