<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title',
        'description',
        'img',
        'destination',
        'price',
        'duration',
    ];


    // Package can have multiple booking
    public function bookings()
    {
        return $this->hasMany(PackageBooking::class, 'package_id'); // Ensure it refers to 'package_id'
    }

}



