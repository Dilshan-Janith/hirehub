@extends('layouts.admin')
@section('title', $booking->booking_no)
@section('content')
<h1>{{ $booking->booking_no }}</h1>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 mb-4">
            <h2 class="h4">Booking details</h2>
            <dl class="row mb-0">
                <dt class="col-4">Customer</dt><dd class="col-8">{{ $booking->customer->name }}</dd>
                <dt class="col-4">Phone</dt><dd class="col-8">{{ $booking->customer->phone }}</dd>
                <dt class="col-4">Email</dt><dd class="col-8">{{ $booking->customer->email }}</dd>
                <dt class="col-4">Date</dt><dd class="col-8">{{ $booking->booking_date->format('d M Y') }}</dd>
                <dt class="col-4">Address</dt><dd class="col-8">{{ $booking->service_address }}, {{ $booking->district }}</dd>
                <dt class="col-4">Item</dt><dd class="col-8">{{ $booking->items->first()?->listing_name }}</dd>
                <dt class="col-4">Total</dt><dd class="col-8">LKR {{ number_format((float) $booking->grand_total, 2) }}</dd>
            </dl>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <h2 class="h4">Status history</h2>
            <table class="table">
                <thead><tr><th>Time</th><th>From</th><th>To</th><th>Changed by</th></tr></thead>
                <tbody>
                @foreach ($booking->statusHistory as $history)
                    <tr>
                        <td>{{ $history->created_at?->format('d M Y H:i') }}</td>
                        <td>{{ $history->old_status ?? '—' }}</td>
                        <td>{{ $history->new_status }}</td>
                        <td>{{ $history->changedBy?->name ?? 'Customer/System' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-4">
            <h2 class="h4">Update booking</h2>
            <form method="post" action="{{ route('admin.bookings.update', $booking) }}">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Provider</label>
                    <select class="form-select" name="provider_id">
                        <option value="">Not assigned</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}" @selected((int) old('provider_id', $booking->provider_id) === $provider->id)>
                                {{ $provider->user->name }} — {{ $provider->district }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Booking status</label>
                    <select class="form-select" name="status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected(old('status', $booking->status->value) === $status->value)>{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Payment status</label>
                    <select class="form-select" name="payment_status">
                        @foreach ($paymentStatuses as $status)
                            <option value="{{ $status->value }}" @selected(old('payment_status', $booking->payment_status->value) === $status->value)>{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Admin note</label>
                    <textarea class="form-control" name="admin_note">{{ old('admin_note', $booking->admin_note) }}</textarea>
                </div>

                <button class="btn btn-dark w-100">Update booking</button>
            </form>
        </div>
    </div>
</div>
@endsection
