<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique();
            $table->string('flight_number');
            $table->string('airline_name');
            $table->string('departure_airport');
            $table->string('arrival_airport');
            $table->dateTime('departure_datetime');
            $table->dateTime('arrival_datetime');
            $table->string('travel_class');
            $table->integer('price');
            $table->string('currency');
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_bookings');
    }
};
