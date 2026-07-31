@extends('layouts.admin')
@section('title', 'Edit provider')
@section('content')
<h1>Edit provider</h1>
<div class="card border-0 shadow-sm p-4">
    <form method="post" action="{{ route('admin.providers.update', $provider) }}">
        @include('admin.providers._form', ['provider' => $provider])
    </form>
</div>
@endsection
