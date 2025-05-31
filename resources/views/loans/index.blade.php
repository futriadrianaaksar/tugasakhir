@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Peminjaman</h1>
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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                        <th>Peminjam</th>
                    @endif
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $index => $loan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                            <td>{{ $loan->user->name }}</td>
                        @endif
                        <td>{{ $loan->book->tittle }}</td>
                        <td>{{ $loan->loan_date->format('d-m-Y') }}</td>
                        <td>{{ $loan->return_due_date->format('d-m-Y') }}</td>
                        <td>{{ $loan->status }}</td>
                        <td>
                            @if ($loan->status === 'dipinjam')
                                @if (auth()->user()->role === 'mahasiswa' || auth()->user()->role === 'petugas')
                                    <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Kembalikan buku ini?')">Kembalikan</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' || auth()->user()->role === 'petugas' ? 6 : 5 }}" class="text-center">Tidak ada peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
