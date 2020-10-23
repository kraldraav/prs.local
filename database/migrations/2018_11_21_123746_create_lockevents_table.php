<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lockevents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_numb', 4);
            $table->integer('trouble_type_id')->references('id')->on('troubletypes');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->integer('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lockevents');
    }
}
