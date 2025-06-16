<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Perpustakaan') }} - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Tema warna */
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --bg-light: #f8f9fa;
            --text-dark: #212529;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f1f5f9;
            color: var(--text-dark);
        }

        /* Navbar atas untuk branding dan logout di layar kecil */
        .navbar-top {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .navbar-top .btn-logout {
            color: white;
            background-color: var(--accent);
            border: none;
        }
        .navbar-top .btn-logout:hover {
            background-color: #c0392b;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            background-color: var(--bg-light);
            padding: 1rem;
            border-right: 1px solid #dee2e6;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .sidebar .nav-link {
            color: var(--text-dark);
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            transition: background-color 0.2s, color 0.2s;
        }
        .sidebar .nav-link:hover {
            background-color: var(--secondary);
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: var(--secondary);
            color: white;
            font-weight: 600;
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        .sidebar .btn-link {
            color: var(--accent);
            text-decoration: none;
            width: 100%;
            text-align: left;
        }

        /* Konten utama */
        main {
            padding: 2rem;
            background-color: white;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: var(--primary);
            color: white;
            border-radius: 10px 10px 0 0;
            font-weight: 500;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            border: 1px solid #e9ecef;
            padding: 0.75rem;
        }
        .table thead th {
            background-color: var(--primary);
            color: white;
        }
        .btn-primary, .btn-success, .btn-danger {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: background-color 0.2s;
        }
        .btn-primary {
            background-color: var(--secondary);
            border: none;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-success:hover {
            background-color: #157347;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Responsivitas */
        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                z-index: 1000;
                transform: translateX(0);
            }
            .sidebar.active {
                transform: translateX(250px);
            }
            main {
                margin-left: 0 !important;
                padding: 1rem;
            }
        }
        @media (min-width: 992px) {
            .navbar-top .navbar-collapse {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar atas -->
    <nav class="navbar navbar-top navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Perpustakaan') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-logout">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
                <!-- Sidebar -->
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="position-sticky pt-3">
                        <h4 class="px-3">{{ config('app.name', 'Perpustakaan') }}</h4>
                        <hr>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'active' : '' }}" href="{{ route(auth()->user()->role . '.dashboard') }}">
                                    <i class="bi bi-house"></i> Dashboard
                                </a>
                            </li>
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
                                        <i class="bi bi-book"></i> Buku
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}" href="{{ route('admin.loans.index') }}">
                                        <i class="bi bi-journal-text"></i> Peminjaman
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                        <i class="bi bi-people"></i> Daftar Pengguna
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.fine_rules.*') ? 'active' : '' }}" href="{{ route('admin.fine_rules.index') }}">
                                        <i class="bi bi-currency-dollar"></i> Denda
                                    </a>
                                </li>
                            @elseif(auth()->user()->role === 'petugas')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('petugas.loans.*') ? 'active' : '' }}" href="{{ route('petugas.loans.index') }}">
                                        <i class="bi bi-journal-text"></i> Peminjaman
                                    </a>
                                </li>
                            @elseif(auth()->user()->role === 'mahasiswa')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                                        <i class="bi bi-book"></i> Daftar Buku
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            @endauth

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
