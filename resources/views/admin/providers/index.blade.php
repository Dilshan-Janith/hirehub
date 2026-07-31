@extends('layouts.admin')
@section('title', 'Providers')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Providers</h1>
    <a class="btn btn-dark" href="{{ route('admin.providers.create') }}">Add provider</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Name</th><th>Type</th><th>District</th><th>Verification</th><th></th></tr></thead>
            <tbody>
            @foreach ($providers as $provider)
                <tr>
                    <td>{{ $provider->user->name }}</td>
                    <td>{{ str($provider->provider_type)->replace('_', ' ')->title() }}</td>
                    <td>{{ $provider->district }}</td>
                    <td>{{ ucfirst($provider->verification_status) }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('admin.providers.edit', $provider) }}">Edit</a>
                        <form class="d-inline" method="post" action="{{ route('admin.providers.destroy', $provider) }}" onsubmit="return confirm('Delete provider?')">
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
<div class="mt-3">{{ $providers->links() }}</div>
@endsection
