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
        Schema::create('package_cancellation_refunds', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('package_booking_id');
            $table->date('cancellation_date'); 
            $table->string('cancellation_reason')->nullable(); 
            $table->date('refund_date');
            $table->float('refund_amount'); 
            $table->timestamps(); 

            $table->foreign('package_booking_id')->references('id')->on('package_bookings')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_cancellation_refunds');
    }
};
