<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    protected $fillable = [
        'flight_code',
        'airline_id',
        'departure_airport_id',
        'arrival_airport_id',
        'departure_date',
        'bookingdate',
        'duration',
        'price',
    ];


    public function airline()
    {
        return $this->belongsTo(Airlines::class, 'airline_id','id');
    }

    /**
     * Get the departure airport associated with the flight.
     */
    public function departureAirport()
    {
        return $this->belongsTo(Airports::class, 'departure_airport_id','id');
    }

    /**
     * Get the arrival airport associated with the flight.
     */
    public function arrivalAirport()
    {
        return $this->belongsTo(Airports::class, 'arrival_airport_id','id');
    }



}
