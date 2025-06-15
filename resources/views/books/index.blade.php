@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h1>Daftar Buku</h1>
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('books.search') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari buku..." value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>ISBN</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada buku ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
