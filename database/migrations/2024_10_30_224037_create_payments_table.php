<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Payment;
use App\Http\Controllers\PaymentController;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id');            
            $table->integer('event_id')->nullable(); // this field will be important to know when a ticket was bought
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->boolean('status');
            $table->string('type')->nullable()->default('ticket'); // ticket or event 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
