<!-- resources/views/loans/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Peminjaman</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($loans->isNotEmpty())
                                @foreach ($loans as $index => $loan)
                                    <tr>
                                        <td>{{ $loans->firstItem() + $index }}</td>
                                        <td>{{ $loan->user->name }}</td>
                                        <td>{{ $loan->book->title }}</td>
                                        <td>{{ $loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') : '-' }}</td>
                                        <td>{{ $loan->status }}</td>
                                        <td>
                                            @if ($loan->status == 'borrowed')
                                                <form action="{{ route('loans.return', $loan->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Kembalikan</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada peminjaman.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $loans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

