@extends('layouts.app')

      @section('content')
          <div class="bg-white p-6 rounded-lg shadow">
              <h1 class="text-2xl font-bold mb-4">Dashboard Mahasiswa</h1>
              <p>Selamat datang, {{ Auth::user()->name }}! Anda dapat melihat dan meminjam buku.</p>
              <div class="mt-4 space-x-2">
                  <a href="{{ route('books.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Lihat Buku</a>
                  <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Profil</a>
              </div>
          </div>
      @endsection
