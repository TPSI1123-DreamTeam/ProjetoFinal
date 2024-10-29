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
            //$table->timestamps('startDate')->nullable(); // 2024-11-01 08:00:00
            $table->timestamp('start_date', precision: 0)->nullable();
            $table->timestamp('end_date', precision: 0)->nullable();
            //$table->timestamps('endDate')->nullable();   // 2024-11-01 23:59:59
            $table->string('type');    // public, private
            $table->decimal('amount');
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
