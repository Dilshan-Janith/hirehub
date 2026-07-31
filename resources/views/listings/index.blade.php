@extends('layouts.app')

@section('title', $type->value === 'manpower' ? 'Hire manpower' : 'Hire tools')

@section('content')
<div class="container py-5">
    <h1>{{ $type->value === 'manpower' ? 'Hire manpower' : 'Hire tools and equipment' }}</h1>

    <form class="row g-2 my-4">
        <div class="col-md-5">
            <input class="form-control" name="search" value="{{ request('search') }}" placeholder="Search listings">
        </div>
        <div class="col-md-4">
            <input class="form-control" name="district" value="{{ request('district') }}" placeholder="District">
        </div>
        <div class="col-md-3">
            <button class="btn btn-dark w-100">Search</button>
        </div>
    </form>

    <div class="row g-4">
        @forelse ($listings as $listing)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="badge bg-secondary">{{ $listing->category->name }}</span>
                        <h2 class="h5 mt-3">{{ $listing->name }}</h2>
                        <p>{{ $listing->short_description }}</p>
                        <p class="small text-muted">{{ $listing->district }} · {{ $listing->provider->user->name }}</p>
                        <p class="price">LKR {{ number_format((float) $listing->price, 2) }} / {{ $listing->pricing_unit }}</p>
                        <a href="{{ route('listings.show', $listing) }}" class="btn btn-dark">View and book</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No matching listings.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $listings->links() }}</div>
</div>
@endsection
