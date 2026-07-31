<?php

namespace App\Models;

use App\Enums\ListingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    protected $fillable = [
        'provider_id',
        'category_id',
        'type',
        'name',
        'slug',
        'short_description',
        'description',
        'pricing_unit',
        'price',
        'district',
        'quantity',
        'deposit_amount',
        'is_featured',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'type' => ListingType::class,
            'price' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
            'quantity' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ProviderProfile::class, 'provider_id');
    }

    public function bookingItems(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }
}
