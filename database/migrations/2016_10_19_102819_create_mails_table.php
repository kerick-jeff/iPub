<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('sender', 255);
            $table->string('recipient', 255);
            $table->string('subject', 255)->nullable();
            $table->text('body');
            $table->string('attachment', 255)->nullable();
            $table->boolean('status');
            $table->boolean('is_sent');
            $table->boolean('is_draft');
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
        Schema::drop('mails');
    }
}
