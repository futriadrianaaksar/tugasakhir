@extends('layouts.app')

      @section('content')
          <div class="card p-4 shadow-sm">
              <h1 class="card-title h3 mb-3">Dashboard Admin</h1>
              <p class="card-text">Selamat datang, {{ Auth::user()->name }}! Anda dapat mengelola buku, peminjaman, dan pengguna.</p>
              <div class="mt-3">
                  <a href="{{ route('books.index') }}" class="btn btn-primary me-2">Kelola Buku</a>
                  <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">Profil</a>
                  <a href="#" class="btn btn-primary">Kelola Pengguna</a>
              </div>
          </div>
      @endsection
\App\Models\User::create(['name' => 'Admin 1', 'email' => 'admin1@gmail.com', 'password' => bcrypt('password'), 'role' => 'admin']);
