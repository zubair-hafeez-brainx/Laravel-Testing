<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        Schema::create('cinema', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('cinema_rooms', function($table) {
            $table->increments('id');
            $table->integer('cinema_id')->unsigned();
            $table->foreign('cinema_id')->references('id')->on('cinema')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('room_seats', function($table) {
            $table->increments('id');
            $table->integer('cinema_rooms_id')->unsigned();
            $table->foreign('cinema_rooms_id')->references('id')->on('cinema_rooms')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->string('price');
            $table->string('status');
            $table->string('is_booked');
            $table->timestamps();
        });

        Schema::create('movies', function($table) {
            $table->increments('id');
            $table->integer('cinema_rooms_id')->unsigned();
            $table->foreign('cinema_rooms_id')->references('id')->on('cinema_rooms')->onDelete('cascade');
            $table->string('name');
            $table->string('show_start_time');
            $table->string('show_end_time');
            $table->timestamps();
        });

        Schema::create('ticket', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('room_seats_id')->unsigned();
            $table->foreign('room_seats_id')->references('id')->on('room_seats')->onDelete('cascade');
            $table->integer('movies_id')->unsigned();
            $table->foreign('movies_id')->references('id')->on('movies')->onDelete('cascade');
            $table->string('price');
            $table->timestamps();
        });


        throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
