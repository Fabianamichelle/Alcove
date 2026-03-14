<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    // "The Reading Room" to Display all books
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->latest()->get();
        return view('alcove', compact('books'));
    }

    // The "Entry Form" - Show the page to add a book 
    public function create()
    {
        $books = Book::where('user_id', Auth::id())->latest()->get();
        return view('alcove', compact('books'));
    }

    // The "Researcher" at work , saves the book to SQLite
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:want to read,reading,finished',
            'total_pages' => 'required|integer|min:1',
            'current_page' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        Book::create(array_merge($validated, ['user_id' => Auth::id()]));

        // Redirect back to library
        return redirect()->route('alcove');
    }

    // The "update form" to edit book details
    public function edit(Book $book)
    {
        $books = Book::where('user_id', Auth::id())->latest()->get();
        return view('alcove', compact('book', 'books'));
    }
    
    // The "Editor" - saves changes to an existing book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:want to read,reading,finished',
            'total_pages' => 'required|integer|min:1',
            'current_page' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $book->update($validated);

        return redirect()->route('alcove');
    }

    // The "Archiver" remove a book from the library
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('alcove');
    }

    public function toggleStatus(Book $book)
    {
        $statuses = ['want to read', 'reading', 'finished'];
        $currentIndex = array_search($book->status, $statuses);
        $nextIndex = ($currentIndex + 1) % count($statuses);
        
        $book->update(['status' => $statuses[$nextIndex]]);
        
        return back();
    }
}
