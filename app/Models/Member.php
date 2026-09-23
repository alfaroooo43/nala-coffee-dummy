<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'password', 'status', 'registered_at', 'last_active_at'];

    protected $hidden = ['password'];

    protected $casts = [
        'registered_at' => 'datetime',
        'last_active_at' => 'datetime',
        'password' => 'hashed',
    ];
}
