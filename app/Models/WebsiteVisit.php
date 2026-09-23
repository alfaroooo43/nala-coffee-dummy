<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteVisit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['visitor_id', 'session_id', 'page', 'referrer', 'device', 'browser', 'ip_hash', 'visited_at'];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
