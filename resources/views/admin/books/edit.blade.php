@extends('layouts.app')

@section('content')
    <h1>Edit Buku</h1>
    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                </div>
                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
                </div>
                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stock" class="form-control" value="{{ $book->stock }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
