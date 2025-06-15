<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $books = Book::count();
            $users = User::whereIn('role', ['petugas', 'mahasiswa'])->count();
            $loans = Loan::count();
            $totalFines = Loan::sum('fine_amount');
            return view('admin.dashboard', compact('books', 'users', 'loans', 'totalFines'));
        } elseif (auth()->user()->role === 'petugas') {
            $loans = Loan::with(['user', 'book'])->whereIn('status', ['menunggu', 'dipinjam', 'menunggu_pengembalian'])->get();
            return view('petugas.dashboard', compact('loans'));
        } else {
            $loans = Loan::with(['book'])->where('user_id', auth()->id())->get();
            $books = Book::where('stock', '>', 0)->get();
            return view('mahasiswa.dashboard', compact('loans', 'books'));
        }
    }
}
