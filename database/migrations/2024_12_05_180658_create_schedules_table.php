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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->nullable(); 
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('title')->nullable();   
            $table->text('description')->nullable();   
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events');
            $table->foreignId('schedule_id')->constrained('schedules');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('event_schedule');
    }
};
