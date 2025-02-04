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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->float('price');
            $table->dateTime('transaction_date');
            $table->dateTime('delivery_date');
            $table->string('user_address', 255);
            $table->string('user_postal_code', 8);
            $table->string('user_locality', 50);
            $table->string('user_phone_number', 15);
            $table->string('user_nif', 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
