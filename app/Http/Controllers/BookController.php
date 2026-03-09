<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller
{
    // "The Reading Room" to Display all books
    public function index()
    {
        $books = Book::latest()->get();
        return view('alcove', compact('books'));
    }

    // The "Entry Form" - Show the page to add a book 
    public function create()
    {
        $books = Book::latest()->get();
        return view('alcove', compact('books'));
    }

    // The "Researcher" at work , saves the book to SQLite
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:want to read,reading,finished',
        ]);

        Book::create($validated);

        // Redirect back to library
        return redirect()->route('alcove');
    }

    // The "update form" to edit book details
    public function edit(Book $book)
    {
        return view('alcove', compact('book'));
    }
    
    // The "Archiver" remove a book from the library 
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('alcove');
    }

}
