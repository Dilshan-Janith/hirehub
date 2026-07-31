<?php

namespace App\Models;

use App\Enums\ListingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'listing_id',
        'listing_name',
        'listing_type',
        'pricing_unit',
        'unit_price',
        'quantity',
        'duration',
        'deposit_amount',
        'line_total',
    ];

    protected function casts(): array
    {
        return [
            'listing_type' => ListingType::class,
            'unit_price' => 'decimal:2',
            'duration' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
            'line_total' => 'decimal:2',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
