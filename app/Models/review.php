<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'review',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

  
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id','id');
    }

}