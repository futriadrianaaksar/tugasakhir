@extends('layouts.app')

@section('title', 'Edit Aturan Denda')

@section('content')
    <h1>Edit Aturan Denda</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.fine_rules.update', $fineRule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="amount_per_day" class="form-label">Denda per Hari (Rp)</label>
                    <input type="number" step="0.01" class="form-control" id="amount_per_day" name="amount_per_day" value="{{ old('amount_per_day', $fineRule->amount_per_day) }}" required>
                    @error('amount_per_day')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="max_days" class="form-label">Maksimum Hari Pinjam</label>
                    <input type="number" class="form-control" id="max_days" name="max_days" value="{{ old('max_days', $fineRule->max_days) }}" required>
                    @error('max_days')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.fine_rules.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
