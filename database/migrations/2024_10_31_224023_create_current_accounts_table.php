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
        Schema::create('current_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->string('form_of_payment')->default('credit_card'); ;     
            $table->foreignId('event_id')->constrained('events');
            $table->boolean('status');
            $table->string('currency')->default('eur'); // eur - by default
            $table->timestamps();
        });

        Schema::create('current_account_payment', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->foreignId('current_account_id')->constrained('current_accounts');
            $table->foreignId('payment_id')->constrained('payments');
            $table->decimal('amount', 10, 2)->nullable();            
            $table->timestamps();          
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_accounts');
    }
};
