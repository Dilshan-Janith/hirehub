@extends('layouts.app')

@section('title', 'Booking received')

@section('content')
<div class="container py-5">
    <div class="card p-5 text-center">
        <h1>Booking request received</h1>
        <p class="lead">Your reference number is:</p>
        <div class="display-6 fw-bold text-success">{{ $booking->booking_no }}</div>
        <p class="mt-3">Estimated total: LKR {{ number_format((float) $booking->grand_total, 2) }}</p>
        <p>An administrator will review the request and contact you.</p>
        <a class="btn btn-dark" href="{{ route('home') }}">Return home</a>
    </div>
</div>
@endsection
