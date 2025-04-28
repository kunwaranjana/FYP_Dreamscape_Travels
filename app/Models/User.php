<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function flightBookings()
    {
        return $this->hasMany(FlightBooking::class,'flight_id','id'); // Assumes foreign key 'user_id' in the 'flight_bookings' table
    }

    public function packageBookings()
    {
        return $this->hasMany(PackageBooking::class, 'user_id', 'id');
    }
    
    public function payments()
    {
        return $this->hasMany(PackagePayment::class, 'user_id', 'id');
    }
    

// hasMany is used when the foreign key is directly in the related model.
// hasManyThrough is used when the foreign key exists in an intermediate model, and you want to access a distant model via that intermediate model.

    // public function packageCancellationRefunds()
    // {
    //     return $this->hasManyThrough(PackageCancellationRefund::class, PackageBooking::class);
        
    // }

    // public function flightCancellationRefunds()
    // {
    //     return $this->hasManyThrough(FlightCancellationRefund::class, FlightBooking::class);
       
    // }



}
