@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@if (isset($error))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ $error }}
    </div>
@endif

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

<div class="row">
    <!-- Daftar Buku -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Buku (5 Teratas)</h3>
                <div class="card-tools">
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-list"></i> Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kode ISBN</th>
                                <th>Penulis</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($books) && $books->isNotEmpty())
                                @foreach($books as $index => $book)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $book->title ?? '-' }}</td>
                                        <td>{{ $book->isbn ?? '-' }}</td>
                                        <td>{{ $book->author ?? '-' }}</td>
                                        <td>{{ $book->stock ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada buku.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Peminjaman -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Peminjaman (5 Teratas)</h3>
                <div class="card-tools">
                    <a href="{{ route('loans.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-list"></i> Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                                @if (Auth::user()->role !== 'mahasiswa')
                                    <th>Peminjam</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($loans) && $loans->isNotEmpty())
                                @foreach($loans as $index => $loan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ optional($loan->book)->title ?? 'Buku tidak ditemukan' }}</td>
                                        <td>{{ $loan->loan_date ? $loan->loan_date->format('d-m-Y') : '-' }}</td>
                                        <td>{{ $loan->status ?? '-' }}</td>
                                        @if (Auth::user()->role !== 'mahasiswa')
                                            <td>{{ optional($loan->user)->name ?? 'Pengguna tidak ditemukan' }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="{{ Auth::user()->role !== 'mahasiswa' ? 5 : 4 }}" class="text-center">Belum ada peminjaman.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
