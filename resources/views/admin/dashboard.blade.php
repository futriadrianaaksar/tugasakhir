@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard Admin</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Buku</h5>
                    <p>{{ $books }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Pengguna</h5>
                    <p>{{ $users }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Peminjaman</h5>
                    <p>{{ $loans }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Denda (Rp)</h5>
                    <p>{{ number_format($totalFines, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
