<?php

namespace App\Http\Controllers;

use App\Actions\Booking\CreateBookingAction;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function store(
        StoreBookingRequest $request,
        CreateBookingAction $action
    ): View {
        $booking = $action->execute($request->validated());

        return view('booking-success', compact('booking'));
    }
}
