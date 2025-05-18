<?php

     use App\Http\Controllers\ProfileController;
     use App\Http\Controllers\BookController;
     use App\Http\Controllers\DashboardController;
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

         // Dashboard generik
         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

         // Dashboard per peran
         Route::middleware('role:admin')->get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
         Route::middleware('role:petugas')->get('/petugas/dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');
         Route::middleware('role:mahasiswa')->get('/mahasiswa/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');

         // Rute untuk buku
         Route::middleware('role:admin,petugas')->group(function () {
             Route::resource('books', BookController::class)->except(['index']);
         });

         Route::get('/books', [BookController::class, 'index'])->name('books.index');
     });
     
