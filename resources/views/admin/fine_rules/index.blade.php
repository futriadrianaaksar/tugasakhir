@extends('layouts.app')

@section('title', 'Daftar Aturan Denda')

@section('content')
    <h1>Daftar Aturan Denda</h1>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.fine_rules.create') }}" class="btn btn-primary">Tambah Aturan Denda</a>
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
                        <th>Denda per Hari (Rp)</th>
                        <th>Maksimum Hari Pinjam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fineRules as $fineRule)
                        <tr>
                            <td>{{ number_format($fineRule->amount_per_day, 2) }}</td>
                            <td>{{ $fineRule->max_days }}</td>
                            <td>
                                <a href="{{ route('admin.fine_rules.edit', $fineRule->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.fine_rules.destroy', $fineRule->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus aturan denda ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
