@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="card">
    <div class="card-header">
        @if (Auth::user()->role !== 'mahasiswa')
            <a href="{{ route('books.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Buku</a>
        @endif
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('error') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kode ISBN</th>
                        <th>Penulis</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($books) && $books->isNotEmpty())
                        @foreach($books as $index => $book)
                            <tr>
                                <td>{{ $books->firstItem() + $index }}</td>
                                <td>{{ $book->title ?? '-' }}</td>
                                <td>{{ $book->isbn ?? '-' }}</td>
                                <td>{{ $book->author ?? '-' }}</td>
                                <td>{{ $book->stock ?? 0 }}</td>
                                <td>
                                    @if (Auth::user()->role === 'mahasiswa')
                                        <form action="{{ route('books.borrow', $book->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-hand-holding"></i> Pinjam
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Belum ada buku.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $books->links() ?? '' }}
    </div>
</div>
@endsection
