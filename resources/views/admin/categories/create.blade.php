@extends('layouts.admin')
@section('title', 'Add category')
@section('content')
<h1>Add category</h1>
<div class="card border-0 shadow-sm p-4">
    <form method="post" action="{{ route('admin.categories.store') }}">
        @include('admin.categories._form')
    </form>
</div>
@endsection
