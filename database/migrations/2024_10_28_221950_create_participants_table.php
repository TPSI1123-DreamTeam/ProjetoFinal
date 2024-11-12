<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('participants', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('phone');
        //     $table->string('email');
        //     $table->boolean('confirmation')->nullable();
        //     $table->integer('user_id')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });       

        // Schema::create('event_participant', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('event_id')->constrained('events');
        //     $table->foreignId('participant_id')->constrained('participants');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {    
        Schema::dropIfExists('participants');  
        Schema::dropIfExists('event_participant');      
    }
};
