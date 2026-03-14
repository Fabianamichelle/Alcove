<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{

   public function index()
    {
        $booksQuery = Book::where('user_id', Auth::id())->latest()->get();
        
        // Grouping for the columns
        $shelves = $booksQuery->groupBy('status');
        
        // Calm Stat: Total pages read across all books
        $totalPagesRead = $booksQuery->sum('current_page');

        return view('alcove', compact('shelves', 'totalPagesRead'));
    }

    public function create()
    {
        return $this->index(); // Keeps it dry by reusing the index logic
    }

    public function edit(Book $book)
    {
        $booksQuery = Book::where('user_id', Auth::id())->latest()->get();
        $shelves = $booksQuery->groupBy('status');
        $totalPagesRead = $booksQuery->sum('current_page');

        return view('alcove', compact('book', 'shelves', 'totalPagesRead'));
    }


    // The "Researcher" at work , saves the book to SQLite
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:want to read,reading,finished',
            'total_pages' => 'required|integer|min:1',
            'current_page' => 'required|integer|min:0|lte:total_pages',
            'notes' => 'nullable|string',
        ]);

        Book::create(array_merge($validated, ['user_id' => Auth::id()]));

        // Redirect back to library
        return redirect()->route('alcove');
    }

    
    // The "Editor" - saves changes to an existing book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:want to read,reading,finished',
            'total_pages' => 'required|integer|min:1',
            'current_page' => 'required|integer|min:0|lte:total_pages',
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
        $newStatus = $statuses[($currentIndex + 1) % count($statuses)];

        $book->update(['status' => $newStatus]);

        if ($newStatus === 'finished') {
            return redirect()->route('alcove')->with('celebrate', true);
        }

        return redirect()->route('alcove');
    }

    public function export()
    {
        // 1. Fetch only the current user's books
        $books = Auth::user()->books()->orderBy('status', 'desc')->get();
        
        // 2. Calculate the "Grand Total" for the victory footer
        $totalPagesRead = $books->sum('current_page');

        // 3. Return the vibrant blade view instead of a text response
        return view('export-journal', compact('books', 'totalPagesRead'));
    }
}