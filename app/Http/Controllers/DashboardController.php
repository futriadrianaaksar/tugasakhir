<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Ambil 5 buku teratas
            $books = Book::take(5)->get() ?? collect();
            // Ambil 5 peminjaman teratas berdasarkan peran
            $loans = Auth::user()->role === 'mahasiswa'
                ? Loan::where('user_id', Auth::id())->take(5)->get() ?? collect()
                : Loan::take(5)->get() ?? collect();

            return view('dashboard', compact('books', 'loans'));
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return view('dashboard', [
                'books' => collect(),
                'loans' => collect(),
                'error' => 'Gagal memuat data dashboard. Silakan coba lagi nanti.'
            ]);
        }
    }
}
