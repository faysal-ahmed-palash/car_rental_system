<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'year',
        'car_type',
        'daily_rent_price',
        'image',
        'status',
    ];

    // A car can have multiple rentals
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
