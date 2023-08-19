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
        Schema::create('friend_ships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'refused'])->default('pending');
            $table->timestamps();
    
            // Make the combination of 'sender' and 'receiver' columns a composite primary key
            // $table->primary(['sender', 'receiver']);
    
            // Optionally, you can add unique constraints on the combination
            // of 'sender' and 'receiver' to prevent duplicate relationships
            $table->unique(['sender_id', 'receiver_id']);
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend_ships');
    }
};
