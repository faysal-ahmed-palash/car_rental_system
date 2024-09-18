<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'address',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Check if the user is a customer
    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    // A user can have multiple rentals
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
