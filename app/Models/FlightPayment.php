<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FlightPayment extends Model
{
    protected $fillable = [
        'flight_booking_id',
        'transaction_code',
        'payment_date',
        'card_name',
        'card_number',
        'payment_method',
        'status',
        'amount',
        'currency',
    ];

    public function booking()
    {
        return $this->belongsTo(FlightBooking::class, 'flight_booking_id');
    }
}
