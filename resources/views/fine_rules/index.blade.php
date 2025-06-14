@extends('layouts.app')

@section('title', 'Daftar Aturan Denda')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Aturan Denda</h3>
        <div class="card-tools">
            <a href="{{ route('fine_rules.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Aturan Denda
            </a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('error') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Denda Per Hari (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($fineRules) && $fineRules->isNotEmpty())
                        @foreach($fineRules as $index => $fineRule)
                            <tr>
                                <td>{{ $fineRules->firstItem() + $index }}</td>
                                <td>{{ number_format($fineRule->fine_per_day, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('fine_rules.edit', $fineRule->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('fine_rules.destroy', $fineRule->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus aturan denda ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">Belum ada aturan denda.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $fineRules->links() ?? '' }}
    </div>
</div>
@endsection
