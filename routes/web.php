<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\FineRuleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    // Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Umum
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard per Peran
    Route::middleware('role:admin')->get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::middleware('role:petugas')->get('/petugas/dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');
    Route::middleware('role:mahasiswa')->get('/mahasiswa/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');

    // Buku (Akses Umum)
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');

    // Buku untuk Admin dan Petugas
    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    });

    // Admin: Kelola Semua
    Route::middleware('role:admin')->group(function () {
        Route::resource('admin/books', BookController::class)->names([
            'index' => 'admin.books.index',
            'create' => 'admin.books.create',
            'store' => 'admin.books.store',
            'show' => 'admin.books.show',
            'edit' => 'admin.books.edit',
            'update' => 'admin.books.update',
            'destroy' => 'admin.books.destroy',
        ]);
        Route::resource('admin/users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
        Route::resource('admin/loans', LoanController::class)->only(['index'])->names([
            'index' => 'admin.loans.index',
        ]);
        Route::resource('admin/fine_rules', FineRuleController::class)->names([
            'index' => 'admin.fine_rules.index',
            'create' => 'admin.fine_rules.create',
            'store' => 'admin.fine_rules.store',
            'show' => 'admin.fine_rules.show',
            'edit' => 'admin.fine_rules.edit',
            'update' => 'admin.fine_rules.update',
            'destroy' => 'admin.fine_rules.destroy',
        ]);
    });

    // Petugas: Kelola Peminjaman
    Route::middleware('role:petugas')->group(function () {
        Route::get('/petugas/loans', [LoanController::class, 'petugasIndex'])->name('petugas.loans.index');
        Route::get('/petugas/loans/create', [LoanController::class, 'create'])->name('petugas.loans.create');
        Route::post('/petugas/loans', [LoanController::class, 'store'])->name('petugas.loans.store');
        Route::post('/petugas/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('petugas.loans.return');
        Route::post('/petugas/loans/{loan}/approve', [LoanController::class, 'approve'])->name('petugas.loans.approve');
        Route::post('/petugas/loans/{loan}/approve-return', [LoanController::class, 'approveReturn'])->name('petugas.loans.approve_return');
        Route::delete('/petugas/loans/{loan}/cancel', [LoanController::class, 'cancel'])->name('petugas.loans.cancel');
    });

    // Mahasiswa: Peminjaman dan Pengembalian
    Route::middleware('role:mahasiswa')->group(function () {
        Route::post('/mahasiswa/loans', [LoanController::class, 'mahasiswaRequest'])->name('mahasiswa.loans.request');
        Route::post('/mahasiswa/loans/{loan}/return', [LoanController::class, 'mahasiswaReturn'])->name('mahasiswa.loans.return');
        Route::delete('/mahasiswa/loans/{loan}/cancel', [LoanController::class, 'mahasiswaCancel'])->name('mahasiswa.loans.cancel');
    });
});
