@extends('layouts.admin')
@section('title', 'Edit category')
@section('content')
<h1>Edit category</h1>
<div class="card border-0 shadow-sm p-4">
    <form method="post" action="{{ route('admin.categories.update', $category) }}">
        @include('admin.categories._form', ['category' => $category])
    </form>
</div>
@endsection
