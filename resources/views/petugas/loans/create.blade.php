@extends('layouts.app')

@section('title', 'Catat Peminjaman Baru')

@section('content')
    <h1>Catat Peminjaman Baru</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('petugas.loans.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label">Peminjam</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Pilih Peminjam</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="book_id" class="form-label">Buku</label>
                    <select class="form-control" id="book_id" name="book_id" required>
                        <option value="">Pilih Buku</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->stock }})</option>
                        @endforeach
                    </select>
                    @error('book_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="loan_date" class="form-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control" id="loan_date" name="loan_date" value="{{ old('loan_date', now()->format('Y-m-d')) }}" required>
                    @error('loan_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('petugas.loans.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
