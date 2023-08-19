<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('friend_ship_id');
            $table->foreign('friend_ship_id')->references('id')->on('friend_ships')->onDelete('cascade');   
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');   
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
        Schema::dropIfExists('messages');
    }
};
