<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FineRuleController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rute autentikasi
require __DIR__.'/auth.php';

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard per peran
    Route::middleware('role:admin')->get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::middleware('role:petugas')->get('/petugas/dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');
    Route::middleware('role:mahasiswa')->get('/mahasiswa/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');

    // Rute untuk buku
    // Semua peran: Melihat daftar buku
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    // Admin dan petugas: Full CRUD
    Route::middleware('role:admin,petugas')->group(function () {
        Route::resource('books', BookController::class)->except(['index']);
    });

    // Mahasiswa: Peminjaman buku
    Route::middleware('role:mahasiswa')->post('/books/{book_id}/borrow', [BookController::class, 'borrow'])->name('books.borrow');

    // Peminjaman
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::post('/loans/{loan_id}/return', [LoanController::class, 'return'])->name('loans.return');

    // Pengelolaan aturan denda (hanya untuk admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('fine_rules', FineRuleController::class);


    });
});
