<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightSeat extends Model
{
    protected $fillable = [
        'total_seat',
        'flight_id',
        'class_id',
    ];

    public function flight()
    {
        return $this->belongsTo(Flights::class,'flight_id', 'id');
    }

  
    public function class()
    {
        return $this->belongsTo(SeatClass::class, 'class_id', 'id');
    }





}
