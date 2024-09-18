<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_days',
        'per_day_cost',
        'total_cost',
        'status',
    ];

    // A rental belongs to one car
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    // A rental belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
