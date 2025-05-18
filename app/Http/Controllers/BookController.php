<?php

   namespace App\Http\Controllers;

   use App\Models\Book;
   use Illuminate\Http\Request;

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
               'title' => 'required|string|max:255',
               'author' => 'required|string|max:255',
               'isbn' => 'nullable|string|max:255|unique:books',
               'stock' => 'required|integer|min:0',
           ], [
               'title.required' => 'Book title is required.',
               'author.required' => 'Author name is required.',
               'isbn.unique' => 'ISBN is already registered.',
               'stock.required' => 'Book stock is required.',
           ]);

           Book::create($request->all());

           return redirect()->route('books.index')->with('success', 'Book added successfully.');
       }

       public function edit(Book $book)
       {
           return view('books.edit', compact('book'));
       }

       public function update(Request $request, Book $book)
       {
           $request->validate([
               'title' => 'required|string|max:255',
               'author' => 'required|string|max:255',
               'isbn' => 'nullable|string|max:255|unique:books,isbn,' . $book->id,
               'stock' => 'required|integer|min:0',
           ]);

           $book->update($request->all());

           return redirect()->route('books.index')->with('success', 'Book updated successfully.');
       }

       public function destroy(Book $book)
       {
           $book->delete();
           return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
       }
   }
