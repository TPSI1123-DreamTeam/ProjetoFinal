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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->text('description')->nullable();   
            $table->string('localization')->nullable();   
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->string('type')->default('private'); // public, private
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('image')->nullable(); 
            $table->integer('owner_id')->nullable();
            $table->integer('manager_id')->nullable();  
            $table->foreignId('category_id')->constrained()->nullable();
            $table->integer('number_of_participants')->nullable();
            $table->boolean('event_confirmation')->default(false);
            $table->json('services_default_array')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('confirmation')->default(false);
            $table->timestamps();
        });
    }

    //supplierID
    //guestID
    //templateEventID

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_user');
    }
};
