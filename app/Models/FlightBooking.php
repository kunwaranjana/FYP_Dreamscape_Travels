<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = [
        'reference_code',
        'flight_number',
        'airline_name',
        'departure_airport',
        'arrival_airport',
        'departure_datetime',
        'arrival_datetime',
        'travel_class',
        'price',
        'currency',
        'user_id', // optional, if you associate with users
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function payment()
{
    return $this->hasOne(FlightPayment::class);
}


  
}

    