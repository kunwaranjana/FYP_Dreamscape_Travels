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
        Schema::create('package_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code');
            $table->foreignId('user_id');
            // $table->foreignId('flight_id')->nullable();
            $table->foreignId('package_booking_id');
            $table->date('payment_date');
            $table->string('method')->default('esewa');
            $table->float('amount');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
            $table->foreign('package_booking_id')->references('id')->on('package_bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_payments');
    }
};
