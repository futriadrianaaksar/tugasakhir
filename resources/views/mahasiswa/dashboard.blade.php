@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <h1>Dashboard Mahasiswa</h1>
    <div class="card mb-4">
        <div class="card-header">
            <h5>Daftar Buku Tersedia</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>ISBN</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>
                                <form action="{{ route('mahasiswa.loans.request') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary" {{ $book->stock < 1 ? 'disabled' : '' }}>Pinjam</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Riwayat Peminjaman</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->loan_date }}</td>
                            <td>{{ $loan->return_date ?? '-' }}</td>
                            <td>{{ $loan->status }}</td>
                            <td>{{ number_format($loan->fine_amount, 2) }}</td>
                            <td>
                                @if($loan->status === 'dipinjam')
                                    <form action="{{ route('mahasiswa.loans.return', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Ajukan Pengembalian</button>
                                    </form>
                                @elseif($loan->status === 'menunggu')
                                    <form action="{{ route('mahasiswa.loans.cancel', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan peminjaman ini?')">Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
