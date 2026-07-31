<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\ProviderProfile;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'pendingBookings' => Booking::where('status', BookingStatus::PENDING)->count(),
            'activeListings' => Listing::where('status', 'active')->count(),
            'verifiedProviders' => ProviderProfile::where('verification_status', 'verified')->count(),
            'recentBookings' => Booking::with('customer', 'items')->latest()->take(8)->get(),
        ]);
    }
}
