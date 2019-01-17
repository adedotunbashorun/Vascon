<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_times', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('slug', 190)->unique();
            $table->integer('user_id')->unsigned()->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('movie_id')->unsigned()->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->integer('cinema_id')->unsigned()->foreign('cinema_id')->references('id')->on('cinemas')->onDelete('cascade');
            $table->string('date')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('show_times');
    }
}
