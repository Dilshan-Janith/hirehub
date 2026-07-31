@extends('layouts.app')

@section('title', $listing->name)

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-6">
            <span class="badge bg-secondary">{{ $listing->category->name }}</span>
            <h1 class="mt-3">{{ $listing->name }}</h1>
            <p class="lead">{{ $listing->short_description }}</p>
            <p>{{ $listing->description }}</p>
            <dl class="row">
                <dt class="col-4">Provider</dt><dd class="col-8">{{ $listing->provider->user->name }}</dd>
                <dt class="col-4">District</dt><dd class="col-8">{{ $listing->district }}</dd>
                <dt class="col-4">Rate</dt><dd class="col-8">LKR {{ number_format((float) $listing->price, 2) }} / {{ $listing->pricing_unit }}</dd>
                <dt class="col-4">Deposit</dt><dd class="col-8">LKR {{ number_format((float) $listing->deposit_amount, 2) }}</dd>
            </dl>
        </div>

        <div class="col-lg-6">
            <div class="card p-4">
                <h2 class="h4">Request this booking</h2>
                <form method="post" action="{{ route('bookings.store') }}">
                    @csrf
                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input class="form-control" name="phone" value="{{ old('phone') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Booking date</label>
                            <input type="date" class="form-control" name="booking_date" min="{{ now()->toDateString() }}" value="{{ old('booking_date') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start time</label>
                            <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <input type="number" min="1" max="{{ $listing->quantity }}" class="form-control" name="quantity" value="{{ old('quantity', 1) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Duration ({{ $listing->pricing_unit }})</label>
                            <input type="number" min="1" step="1" class="form-control" name="duration" value="{{ old('duration', 1) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">District</label>
                            <input class="form-control" name="district" value="{{ old('district') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment method</label>
                            <select class="form-select" name="payment_method">
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank transfer</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Service address</label>
                            <input class="form-control" name="service_address" value="{{ old('service_address') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" name="customer_note">{{ old('customer_note') }}</textarea>
                        </div>
                    </div>

                    <button class="btn btn-warning w-100 mt-4">Submit booking request</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
