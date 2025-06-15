@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1>Daftar Peminjaman</h1>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('petugas.loans.create') }}" class="btn btn-primary">Catat Peminjaman Baru</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                        <tr>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->loan_date }}</td>
                            <td>{{ $loan->return_date ?? '-' }}</td>
                            <td>{{ $loan->status }}</td>
                            <td>{{ number_format($loan->fine_amount, 2) }}</td>
                            <td>
                                @if($loan->status === 'menunggu')
                                    <form action="{{ route('petugas.loans.approve', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                                    </form>
                                @elseif($loan->status === 'dipinjam')
                                    <form action="{{ route('petugas.loans.return', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Kembalikan</button>
                                    </form>
                                @elseif($loan->status === 'menunggu_pengembalian')
                                    <form action="{{ route('petugas.loans.approve_return', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Setujui Pengembalian</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
