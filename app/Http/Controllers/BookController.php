<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tittle' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn|size:13',
            'author' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        Book::create($request->only(['tittle', 'isbn', 'author', 'stock']));

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'tittle' => 'required|string|max:255',
            'isbn' => 'required|string|size:13|unique:books,isbn,' . $book->id,
            'author' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        $book->update($request->only(['tittle', 'isbn', 'author', 'stock']));

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Cek apakah buku sedang dipinjam
        $activeLoans = Loan::where('book_id', $id)->where('status', 'dipinjam')->exists();
        if ($activeLoans) {
            return redirect()->route('books.index')->with('error', 'Buku sedang dipinjam dan tidak bisa dihapus.');
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function borrow(Request $request, $book_id)
    {
        if (Auth::user()->role !== 'mahasiswa') {
            abort(403, 'Unauthorized');
        }

        $book = Book::findOrFail($book_id);

        if ($book->stock <= 0) {
            return redirect()->route('books.index')->with('error', 'Buku tidak tersedia.');
        }

        $existingLoan = Loan::where('user_id', Auth::id())
                           ->where('book_id', $book_id)
                           ->where('status', 'dipinjam')
                           ->exists();
        if ($existingLoan) {
            return redirect()->route('books.index')->with('error', 'Anda sudah meminjam buku ini.');
        }

        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book_id,
            'loan_date' => Carbon::today(),
            'return_due_date' => Carbon::today()->addDays(7),
            'status' => 'dipinjam',
        ]);

        $book->decrement('stock');

        return redirect()->route('books.index')->with('success', 'Buku berhasil dipinjam.');
    }
}
