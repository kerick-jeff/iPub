<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubFilesTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pub_id')->unsigned();
            $table->string('name', 255);
            $table->integer('size');
            $table->string('type');
            $table->foreign('pub_id')
                  ->references('id')->on('pubs')
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
        Schema::drop('pub_files');
    }
}
