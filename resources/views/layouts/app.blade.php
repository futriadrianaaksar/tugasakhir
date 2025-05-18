<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistem Manajemen Perpustakaan Online</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Perpustakaan Online</a>
                <div class="navbar-nav">
                    @auth
                        <span class="navbar-text me-3">Selamat datang, {{ Auth::user()->name }}</span>
                        @if(auth()->user()->role === 'admin')
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profil</a>
                        @elseif(auth()->user()->role === 'petugas')
                            <a class="nav-link" href="{{ route('petugas.dashboard') }}">Dashboard Petugas</a>
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profil</a>
                        @else
                            <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard Mahasiswa</a>
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profil</a>
                        @endif
                        <a class="nav-link" href="{{ route('books.index') }}">Buku</a>
                        <a class="nav-link" href="{{ route('logout') }}">Keluar</a>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        <a class="nav-link" href="{{ route('register') }}">Daftar</a>
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
    </body>
    </html>
