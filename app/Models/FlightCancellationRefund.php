<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightCancellationRefund extends Model
{
    protected $fillable = [
        'flights_booking_id',
        'cancellation_date',
        'cancellation_reason',
        'refund_date',
        'refund_amount',
    ];

    /**
     * Get the flight booking associated with the cancellation refund.
     */
    public function flightBooking()
    {
        return $this->belongsTo(FlightBooking::class, 'flights_booking_id');
    }
}
