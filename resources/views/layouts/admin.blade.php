<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HireHub Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-warning" href="{{ route('admin.dashboard') }}">HireHub Admin</a>
        <form method="post" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <aside class="col-lg-2 bg-white border-end min-vh-100 p-3">
            <nav class="nav flex-column gap-2">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
                <a class="nav-link" href="{{ route('admin.providers.index') }}">Providers</a>
                <a class="nav-link" href="{{ route('admin.listings.index') }}">Listings</a>
                <a class="nav-link" href="{{ route('admin.bookings.index') }}">Bookings</a>
                <a class="nav-link" href="{{ route('home') }}" target="_blank">View website</a>
            </nav>
        </aside>

        <main class="col-lg-10 p-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
