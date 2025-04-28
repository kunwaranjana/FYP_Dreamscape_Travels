<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'booking_date',
        'travelerCount',
        'amount',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id','id');
    }

    public function payment()
    {
        return $this->hasOne(PackagePayment::class, 'package_id', 'package_id');
    }
    
    
    
}