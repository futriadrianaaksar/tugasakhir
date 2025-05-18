@extends('layouts.app')

    @section('content')
        <div class="card text-center mx-auto mt-5" style="max-width: 400px;">
            <div class="card-body">
                <h1 class="card-title h3 mb-3">Selamat Datang di Sistem Manajemen Perpustakaan Online</h1>
                <p class="card-text mb-3">Silakan masuk atau daftar untuk mengakses layanan perpustakaan.</p>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                </div>
            </div>
        </div>
    @endsection
