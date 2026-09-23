<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketplaceClick extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['visitor_id', 'product_id', 'marketplace', 'source', 'device', 'clicked_at'];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
