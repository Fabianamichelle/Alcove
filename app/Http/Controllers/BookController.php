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
        return view('books.index', compact('books'));
    }

    // The "Entry Form" - Show the page to add a book 
    public function create()
    {
        return view('books.create');
    }

    // The "Researcher" at work , saves the book to SQLite
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:want to read, reading, finished',
        ]);

        Book::create($validated);

        // Redirect back to library
        return redirect()->route('books.index');
    }
    

}
