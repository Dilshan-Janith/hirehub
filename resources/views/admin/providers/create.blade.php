@extends('layouts.admin')
@section('title', 'Add provider')
@section('content')
<h1>Add provider</h1>
<div class="card border-0 shadow-sm p-4">
    <form method="post" action="{{ route('admin.providers.store') }}">
        @include('admin.providers._form')
    </form>
</div>
@endsection
