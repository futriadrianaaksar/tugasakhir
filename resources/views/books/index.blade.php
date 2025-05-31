@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Buku</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
            <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
        @endif
        @if (auth()->user()->role === 'mahasiswa')
            <a href="{{ route('loans.index') }}" class="btn btn-info mb-3">Lihat Peminjaman</a>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>ISBN</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $index => $book)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $book->tittle }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            @if (auth()->user()->role === 'mahasiswa')
                                @if ($book->stock > 0)
                                    <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Pinjam</button>
                                    </form>
                                @else
                                    <span class="text-danger">Stok habis</span>
                                @endif
                            @endif
                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada buku yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
