<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'mahasiswa') {
            // Mahasiswa hanya melihat peminjaman mereka sendiri
            $loans = Loan::where('user_id', $user->id)->with('book')->get();
        } else {
            // Admin/petugas melihat semua peminjaman
            $loans = Loan::with('user', 'book')->get();
        }
        return view('loans.index', compact('loans'));
    }

    public function return(Request $request, $loan_id)
    {
        $loan = Loan::findOrFail($loan_id);
        $user = Auth::user();

        // Hanya mahasiswa pemilik atau petugas yang bisa mengembalikan
        if ($user->role === 'mahasiswa' && $loan->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
        if ($user->role !== 'mahasiswa' && $user->role !== 'petugas') {
            abort(403, 'Unauthorized');
        }

        // Pastikan buku masih dipinjam
        if ($loan->status === 'dikembalikan') {
            return redirect()->route('loans.index')->with('error', 'Buku sudah dikembalikan.');
        }

        // Perbarui status dan tambah stok
        $loan->update(['status' => 'dikembalikan']);
        $loan->book->increment('stock');

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan.');
    }
}
