<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perpustakaan Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Perpustakaan Online</a>
            <div class="navbar-nav ms-auto">
                @auth
                    <span class="navbar-text me-3">Selamat datang, {{ Auth::user()->name }}</span>
                    @if(auth()->user()->role === 'admin')
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                    @elseif(auth()->user()->role === 'petugas')
                        <a class="nav-link" href="{{ route('petugas.dashboard') }}">Dashboard Petugas</a>
                    @else
                        <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard Mahasiswa</a>
                    @endif
                    <a class="nav-link" href="{{ route('profile.edit') }}">Profil</a>
                    <a class="nav-link" href="{{ route('books.index') }}">Buku</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white">Keluar</button>
                    </form>
                @else
                    {{-- <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    <a class="nav-link" href="{{ route('register') }}">Daftar</a> --}}
                @endauth
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    <footer class="bg-primary text-white text-center py-3">
        <p>© 2025 Sistem Manajemen Perpustakaan Online</p>
    </footer>

    @stack('scripts')
</body>
</html>
