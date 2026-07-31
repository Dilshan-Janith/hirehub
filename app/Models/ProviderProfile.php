<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProviderProfile extends Model
{
    protected $fillable = [
        'user_id',
        'provider_type',
        'nic_or_registration_no',
        'district',
        'address',
        'description',
        'verification_status',
        'availability_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'provider_id');
    }

    public function assignedBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'provider_id');
    }
}
