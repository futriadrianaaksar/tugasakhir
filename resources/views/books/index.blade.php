@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Daftar Buku</h1>
        <div class="card shadow-sm">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            @auth
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                                    <th>Aksi</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publication_year }}</td>
                                <td>{{ $book->category->name ?? 'N/A' }}</td>
                                @auth
                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                                        <td>
                                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada buku.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @auth
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                <a href="{{ route('books.create') }}" class="btn btn-primary mt-3">Tambah Buku</a>
            @endif
        @endauth
    </div>
@endsection
