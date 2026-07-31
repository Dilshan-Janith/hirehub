<?php

namespace App\Actions\Booking;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ChangeBookingStatusAction
{
    private const ALLOWED_TRANSITIONS = [
        'pending' => ['confirmed', 'cancelled', 'rejected'],
        'confirmed' => ['assigned', 'cancelled'],
        'assigned' => ['in_progress', 'cancelled'],
        'in_progress' => ['completed'],
        'completed' => [],
        'cancelled' => [],
        'rejected' => [],
    ];

    public function execute(
        Booking $booking,
        BookingStatus $newStatus,
        User $changedBy,
        ?string $note = null
    ): Booking {
        $oldStatus = $booking->status;

        if ($oldStatus === $newStatus) {
            return $booking;
        }

        $allowed = self::ALLOWED_TRANSITIONS[$oldStatus->value] ?? [];

        if (! in_array($newStatus->value, $allowed, true)) {
            throw ValidationException::withMessages([
                'status' => "Cannot change booking from {$oldStatus->label()} to {$newStatus->label()}.",
            ]);
        }

        return DB::transaction(function () use ($booking, $oldStatus, $newStatus, $changedBy, $note): Booking {
            $booking->update(['status' => $newStatus]);

            $booking->statusHistory()->create([
                'old_status' => $oldStatus->value,
                'new_status' => $newStatus->value,
                'changed_by' => $changedBy->id,
                'note' => $note,
                'created_at' => now(),
            ]);

            return $booking->refresh();
        });
    }
}
