<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Booking\ChangeBookingStatusAction;
use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\ProviderProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        return view('admin.bookings.index', [
            'bookings' => Booking::with('customer', 'provider.user', 'items')
                ->latest()
                ->paginate(20),
        ]);
    }

    public function show(Booking $booking): View
    {
        return view('admin.bookings.show', [
            'booking' => $booking->load(
                'customer',
                'provider.user',
                'items.listing',
                'statusHistory.changedBy'
            ),
            'providers' => ProviderProfile::with('user')
                ->where('verification_status', 'verified')
                ->orderBy('district')
                ->get(),
            'statuses' => BookingStatus::cases(),
            'paymentStatuses' => PaymentStatus::cases(),
        ]);
    }

    public function update(
        UpdateBookingRequest $request,
        Booking $booking,
        ChangeBookingStatusAction $changeStatus
    ): RedirectResponse {
        $data = $request->validated();

        $booking->update([
            'provider_id' => $data['provider_id'] ?: null,
            'payment_status' => PaymentStatus::from($data['payment_status']),
            'admin_note' => $data['admin_note'] ?? null,
        ]);

        $changeStatus->execute(
            $booking,
            BookingStatus::from($data['status']),
            $request->user(),
            $data['admin_note'] ?? null
        );

        return back()->with('success', 'Booking updated.');
    }
}
