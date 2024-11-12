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
            $table->string('name');   
            //$table->string('category');   
            $table->text('description');   
            $table->string('localization');   
            $table->timestamp('start_date', precision: 0)->nullable();
            $table->timestamp('end_date', precision: 0)->nullable();
            $table->string('type');    // public, private
            $table->decimal('amount', 10, 2);
            $table->string('image'); 
            $table->integer('owner_id');
            $table->integer('manager_id');  
            $table->foreignId('category_id')->constrained();
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
    }
};
