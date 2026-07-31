@extends('layouts.admin')
@section('title', 'Bookings')
@section('content')
<h1 class="mb-4">Bookings</h1>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Reference</th><th>Date</th><th>Customer</th><th>Listing</th><th>Status</th><th>Total</th><th></th></tr></thead>
            <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->booking_no }}</td>
                    <td>{{ $booking->booking_date->format('d M Y') }}</td>
                    <td>{{ $booking->customer->name }}</td>
                    <td>{{ $booking->items->first()?->listing_name }}</td>
                    <td>{{ $booking->status->label() }}</td>
                    <td>LKR {{ number_format((float) $booking->grand_total, 2) }}</td>
                    <td><a class="btn btn-sm btn-dark" href="{{ route('admin.bookings.show', $booking) }}">Open</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $bookings->links() }}</div>
@endsection
