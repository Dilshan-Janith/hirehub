@extends('layouts.admin')
@section('title', 'Edit listing')
@section('content')
<h1>Edit listing</h1>
<div class="card border-0 shadow-sm p-4">
    <form method="post" action="{{ route('admin.listings.update', $listing) }}">
        @include('admin.listings._form', ['listing' => $listing])
    </form>
</div>
@endsection
