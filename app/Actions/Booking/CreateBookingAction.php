<?php

namespace App\Actions\Booking;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateBookingAction
{
    public function execute(array $data): Booking
    {
        return DB::transaction(function () use ($data): Booking {
            $listing = Listing::query()
                ->where('status', 'active')
                ->lockForUpdate()
                ->findOrFail($data['listing_id']);

            $customer = User::query()->firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'password' => Str::password(24),
                    'role' => UserRole::CUSTOMER,
                    'status' => 'active',
                ]
            );

            $customer->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]);

            $quantity = (int) $data['quantity'];

            if ($quantity > $listing->quantity) {
                throw ValidationException::withMessages([
                    'quantity' => "Only {$listing->quantity} unit(s) are available.",
                ]);
            }

            $duration = (float) $data['duration'];
            $unitPrice = (float) $listing->price;
            $lineTotal = round($unitPrice * $quantity * $duration, 2);
            $deposit = round((float) $listing->deposit_amount * $quantity, 2);

            $booking = Booking::query()->create([
                'booking_no' => $this->generateBookingNumber(),
                'customer_id' => $customer->id,
                'booking_date' => $data['booking_date'],
                'start_time' => $data['start_time'] ?? null,
                'service_address' => $data['service_address'],
                'district' => $data['district'],
                'customer_note' => $data['customer_note'] ?? null,
                'subtotal' => $lineTotal,
                'deposit_total' => $deposit,
                'grand_total' => $lineTotal + $deposit,
                'status' => BookingStatus::PENDING,
                'payment_status' => PaymentStatus::UNPAID,
                'payment_method' => $data['payment_method'],
            ]);

            $booking->items()->create([
                'listing_id' => $listing->id,
                'listing_name' => $listing->name,
                'listing_type' => $listing->type,
                'pricing_unit' => $listing->pricing_unit,
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'duration' => $duration,
                'deposit_amount' => $deposit,
                'line_total' => $lineTotal,
            ]);

            $booking->statusHistory()->create([
                'old_status' => null,
                'new_status' => BookingStatus::PENDING->value,
                'changed_by' => null,
                'note' => 'Booking created by customer.',
                'created_at' => now(),
            ]);

            return $booking->load('items', 'customer');
        });
    }

    private function generateBookingNumber(): string
    {
        do {
            $number = 'HH-'.now()->format('Ymd').'-'.strtoupper(Str::random(6));
        } while (Booking::query()->where('booking_no', $number)->exists());

        return $number;
    }
}
