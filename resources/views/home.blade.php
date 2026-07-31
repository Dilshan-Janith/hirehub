@extends('layouts.app')

@section('title', 'Hire manpower and tools')

@section('content')
<section class="hero">
    <div class="container">
        <p class="text-warning fw-bold text-uppercase">Manpower and equipment marketplace</p>
        <h1 class="display-3 fw-bold">Hire the right people and tools for the job.</h1>
        <p class="lead col-lg-8">Browse verified service providers, compare prices and submit a booking request in minutes.</p>
        <a href="{{ route('manpower') }}" class="btn btn-warning btn-lg me-2">Hire manpower</a>
        <a href="{{ route('tools') }}" class="btn btn-outline-light btn-lg">Hire tools</a>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card p-4">
                <h2>{{ $manpowerCount }}</h2>
                <p class="mb-0">Active manpower listings</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <h2>{{ $toolCount }}</h2>
                <p class="mb-0">Active tool listings</p>
            </div>
        </div>
    </div>

    <h2 class="mb-4">Featured listings</h2>
    <div class="row g-4">
        @forelse ($featuredListings as $listing)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="badge bg-secondary">{{ $listing->type->value }}</span>
                        <h3 class="h5 mt-3">{{ $listing->name }}</h3>
                        <p>{{ $listing->short_description }}</p>
                        <p class="price">LKR {{ number_format((float) $listing->price, 2) }} / {{ $listing->pricing_unit }}</p>
                        <a class="btn btn-dark" href="{{ route('listings.show', $listing) }}">View and book</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No featured listings yet.</p>
        @endforelse
    </div>
</div>
@endsection
