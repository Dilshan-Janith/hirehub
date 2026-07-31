@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row g-4 mb-5">
    <div class="col-md-4"><div class="card border-0 shadow-sm p-4"><h2>{{ $pendingBookings }}</h2><p class="mb-0">Pending bookings</p></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm p-4"><h2>{{ $activeListings }}</h2><p class="mb-0">Active listings</p></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm p-4"><h2>{{ $verifiedProviders }}</h2><p class="mb-0">Verified providers</p></div></div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h2 class="h4">Recent bookings</h2>
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Reference</th><th>Customer</th><th>Listing</th><th>Status</th><th>Total</th></tr></thead>
                <tbody>
                @forelse ($recentBookings as $booking)
                    <tr>
                        <td><a href="{{ route('admin.bookings.show', $booking) }}">{{ $booking->booking_no }}</a></td>
                        <td>{{ $booking->customer->name }}</td>
                        <td>{{ $booking->items->first()?->listing_name }}</td>
                        <td>{{ $booking->status->label() }}</td>
                        <td>LKR {{ number_format((float) $booking->grand_total, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No bookings yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
