<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('alcove');
    }
    return redirect()->route('login');
})->name('home');

// Book Routes handling '/', 'alcove', and 'home'

Route::get('/alcove', [BookController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('alcove');

//shadow route for the "dashboard" redirect

Route::get('/dashboard', function () {
    return redirect('/alcove');
})->name('dashboard');


require __DIR__.'/settings.php';


// Add CRUD routes for books 
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('books', BookController::class)->except(['index']);

   // Route for toggling book status
Route::post('/books/{book}/toggle', [BookController::class, 'toggleStatus'])->name('books.toggle');

  // Route for journal export 
Route::get('/export', [BookController::class, 'export'])->name('books.export');
});



//
