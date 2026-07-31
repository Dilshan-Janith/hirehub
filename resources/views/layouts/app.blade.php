<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HireHub Lanka')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f7f8fa; }
        .navbar-brand { font-weight: 800; }
        .hero {
            background: linear-gradient(135deg, #111827, #374151);
            color: white;
            padding: 6rem 0;
        }
        .price { color: #198754; font-weight: 800; }
        .card { border: 0; box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.07); }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand text-warning" href="{{ route('home') }}">HireHub Lanka</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('manpower') }}">Manpower</a>
            <a class="nav-link" href="{{ route('tools') }}">Tools</a>
            <a class="nav-link" href="{{ route('admin.login') }}">Admin</a>
        </div>
    </div>
</nav>

@if ($errors->any())
    <div class="container mt-3">
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@yield('content')

<footer class="bg-dark text-white mt-5 py-4">
    <div class="container">© {{ now()->year }} HireHub Lanka</div>
</footer>
</body>
</html>
