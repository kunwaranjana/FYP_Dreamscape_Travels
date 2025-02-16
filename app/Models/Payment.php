<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
        'package_id',
        'booking_date',
        'method',
        'amount',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

   
    public function flight()
    {
        return $this->belongsTo(Flights::class, 'flight_id','id');
    }

   
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id','id');
    }
}
