<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pubs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title', 255);
            $table->text('description');
            $table->boolean('type')->default(0); // media file type [0 => image, 1 => video]
            $table->string('category');
            $table->string('sub_category');
            $table->enum('priority', [0, 1, 2, 3]);
            $table->integer('views')->unsigned();
            $table->integer('ratings')->unsigned();
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
        Schema::drop('pubs');
    }
}
