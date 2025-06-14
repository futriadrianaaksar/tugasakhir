@extends('layouts.app')

@section('title', 'Tambah Aturan Denda')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Aturan Denda</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('fine_rules.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fine_per_day">Denda Per Hari (Rp)</label>
                <input type="number" name="fine_per_day" id="fine_per_day" class="form-control @error('fine_per_day') is-invalid @enderror" value="{{ old('fine_per_day') }}" min="0">
                @error('fine_per_day')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('fine_rules.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
        </form>
    </div>
</div>
@endsection
