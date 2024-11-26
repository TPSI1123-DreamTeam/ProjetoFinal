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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('email');
            $table->string('image')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->foreignId('event_id')->constrained('events');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->decimal('amount', 10, 2)->nullable();            
            $table->timestamps();          
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('event_supplier');
    }
};
