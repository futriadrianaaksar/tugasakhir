@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Detail Buku</h5>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Judul</dt>
                <dd class="col-sm-9">{{ $book->title }}</dd>
                <dt class="col-sm-3">Penulis</dt>
                <dd class="col-sm-9">{{ $book->author }}</dd>
                <dt class="col-sm-3">ISBN</dt>
                <dd class="col-sm-9">{{ $book->isbn }}</dd>
                <dt class="col-sm-3">Stok</dt>
                <dd class="col-sm-9">{{ $book->stock }}</dd>
            </dl>
            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
