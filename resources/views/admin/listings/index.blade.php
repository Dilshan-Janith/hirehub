@extends('layouts.admin')
@section('title', 'Listings')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Listings</h1>
    <a class="btn btn-dark" href="{{ route('admin.listings.create') }}">Add listing</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Name</th><th>Type</th><th>Provider</th><th>Price</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach ($listings as $listing)
                <tr>
                    <td>{{ $listing->name }}</td>
                    <td>{{ $listing->type->value }}</td>
                    <td>{{ $listing->provider->user->name }}</td>
                    <td>LKR {{ number_format((float) $listing->price, 2) }}</td>
                    <td>{{ $listing->status }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('admin.listings.edit', $listing) }}">Edit</a>
                        <form class="d-inline" method="post" action="{{ route('admin.listings.destroy', $listing) }}" onsubmit="return confirm('Delete listing?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $listings->links() }}</div>
@endsection
