<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
        'booking_date',
        'amount',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

  
    public function flight()
    {
        return $this->belongsTo(Flights::class, 'flight_id','id');
    }
}

    