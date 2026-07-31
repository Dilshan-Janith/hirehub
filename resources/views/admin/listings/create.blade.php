@extends('layouts.admin')
@section('title', 'Add listing')
@section('content')
<h1>Add listing</h1>
<div class="card border-0 shadow-sm p-4">
    <form method="post" action="{{ route('admin.listings.store') }}">
        @include('admin.listings._form')
    </form>
</div>
@endsection
