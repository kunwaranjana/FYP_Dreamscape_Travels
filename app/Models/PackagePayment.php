<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePayment extends Model
{
    protected $fillable = [
        'transaction_code',
        'user_id',
        'package_booking_id',
        'payment_date',
        'method',
        'amount',
        'status',
    ];


    // payment made by one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    // 
    public function packageBooking()
    {
        return $this->belongsTo(PackageBooking::class, 'package_booking_id', 'id');
    }




   

}
