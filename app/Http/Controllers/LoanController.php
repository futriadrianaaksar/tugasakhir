<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use App\Models\FineRule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    // Admin: Lihat semua peminjaman
    public function index()
    {
        $loans = Loan::with(['user', 'book'])->latest()->get();
        return view('admin.loans.index', compact('loans'));
    }

    // Petugas: Lihat peminjaman aktif
    public function petugasIndex()
    {
        $loans = Loan::with(['user', 'book'])
                     ->whereIn('status', ['menunggu', 'dipinjam', 'menunggu_pengembalian'])
                     ->latest()
                     ->get();
        return view('petugas.loans.index', compact('loans'));
    }

    // Petugas: Form peminjaman baru
    public function create()
    {
        $users = User::where('role', 'mahasiswa')->get();
        $books = Book::where('stock', '>', 0)->get();
        return view('petugas.loans.create', compact('users', 'books'));
    }

    // Petugas: Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
        ]);

        // Cek batas peminjaman (maksimal 3 buku)
        $activeLoans = Loan::where('user_id', $request->user_id)
                           ->whereIn('status', ['menunggu', 'dipinjam'])
                           ->count();
        if ($activeLoans >= 3) {
            return back()->withErrors(['user_id' => 'Mahasiswa sudah meminjam maksimal 3 buku.']);
        }

        $book = Book::findOrFail($request->book_id);
        if ($book->stock < 1) {
            return back()->withErrors(['book_id' => 'Stok buku tidak cukup.']);
        }

        $book->decrement('stock');

        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('petugas.loans.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    // Petugas: Tandai pengembalian
    public function returnBook(Request $request, Loan $loan)
    {
        if ($loan->status === 'dikembalikan') {
            return back()->withErrors(['status' => 'Buku sudah dikembalikan.']);
        }

        $fineRule = FineRule::first();
        if (!$fineRule) {
            return back()->withErrors(['fine_rule' => 'Aturan denda belum diatur.']);
        }

        $loan->update([
            'return_date' => Carbon::now()->format('Y-m-d'),
            'status' => 'dikembalikan',
            'fine_amount' => $loan->calculateFine(),
        ]);

        $book = Book::findOrFail($loan->book_id);
        $book->increment('stock');

        return redirect()->route('petugas.loans.index')->with('success', 'Pengembalian berhasil dicatat.');
    }

    // Mahasiswa: Ajukan peminjaman
    public function mahasiswaRequest(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // Cek batas peminjaman
        $activeLoans = Loan::where('user_id', auth()->id())
                           ->whereIn('status', ['menunggu', 'dipinjam'])
                           ->count();
        if ($activeLoans >= 3) {
            return back()->withErrors(['book_id' => 'Anda sudah meminjam maksimal 3 buku.']);
        }

        $book = Book::findOrFail($request->book_id);
        if ($book->stock < 1) {
            return back()->withErrors(['book_id' => 'Stok buku tidak cukup.']);
        }

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'loan_date' => Carbon::now()->format('Y-m-d'),
            'status' => 'menunggu',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Permintaan peminjaman telah diajukan.');
    }

    // Petugas: Setujui peminjaman
    public function approve(Request $request, Loan $loan)
    {
        if ($loan->status !== 'menunggu') {
            return back()->withErrors(['status' => 'Peminjaman tidak dalam status menunggu.']);
        }

        $book = Book::findOrFail($loan->book_id);
        if ($book->stock < 1) {
            return back()->withErrors(['book_id' => 'Stok buku tidak cukup.']);
        }

        $book->decrement('stock');

        $loan->update([
            'status' => 'dipinjam',
        ]);

        return redirect()->route('petugas.loans.index')->with('success', 'Peminjaman disetujui.');
    }

    // Mahasiswa: Ajukan pengembalian
    public function mahasiswaReturn(Request $request, Loan $loan)
    {
        if ($loan->status !== 'dipinjam' || $loan->user_id !== auth()->id()) {
            return back()->withErrors(['status' => 'Peminjaman tidak valid untuk pengembalian.']);
        }

        $loan->update([
            'status' => 'menunggu_pengembalian',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Permintaan pengembalian telah diajukan.');
    }

    // Petugas: Setujui pengembalian
    public function approveReturn(Request $request, Loan $loan)
    {
        if ($loan->status !== 'menunggu_pengembalian') {
            return back()->withErrors(['status' => 'Peminjaman tidak dalam status menunggu pengembalian.']);
        }

        $fineRule = FineRule::first();
        if (!$fineRule) {
            return back()->withErrors(['fine_rule' => 'Aturan denda belum diatur.']);
        }

        $loan->update([
            'return_date' => Carbon::now()->format('Y-m-d'),
            'status' => 'dikembalikan',
            'fine_amount' => $loan->calculateFine(),
        ]);

        $book = Book::findOrFail($loan->book_id);
        $book->increment('stock');

        return redirect()->route('petugas.loans.index')->with('success', 'Pengembalian disetujui.');
    }

    // Petugas: Batalkan peminjaman
    public function cancel(Request $request, Loan $loan)
    {
        if (!in_array($loan->status, ['menunggu', 'dipinjam'])) {
            return back()->withErrors(['status' => 'Peminjaman tidak dapat dibatalkan.']);
        }

        if ($loan->status === 'dipinjam') {
            $book = Book::findOrFail($loan->book_id);
            $book->increment('stock');
        }

        $loan->delete();

        return redirect()->route('petugas.loans.index')->with('success', 'Peminjaman berhasil dibatalkan.');
    }

    // Mahasiswa: Batalkan peminjaman
    public function mahasiswaCancel(Request $request, Loan $loan)
    {
        if ($loan->status !== 'menunggu' || $loan->user_id !== auth()->id()) {
            return back()->withErrors(['status' => 'Peminjaman tidak dapat dibatalkan.']);
        }

        $loan->delete();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Permintaan peminjaman berhasil dibatalkan.');
    }
}
