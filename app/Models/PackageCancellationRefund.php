<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCancellationRefund extends Model
{
    protected $fillable = [
        'package_booking_id',
        'cancellation_date',
        'cancellation_reason',
        'refund_date',
        'refund_amount',
    ];

    /**
     * Get the package booking associated with the cancellation refund.
     */
    public function packageBooking()
    {
        return $this->belongsTo(PackageBooking::class, 'package_booking_id');
    }
}
