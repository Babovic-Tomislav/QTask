<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/authors', [AuthorController::class, 'listAction'])->name('author.list');
    Route::delete('/authors/{author}', [AuthorController::class, 'deleteAction'])->name('author.delete');
    Route::get('/authors/{author}', [AuthorController::class, 'detailsAction'])->name('author.details');

    Route::get('/books/create', [BookController::class, 'createFormAction'])->name('book.createForm');
    Route::post('/books/create', [BookController::class, 'createAction'])->name('book.create');
    Route::delete('/books/{book}', [BookController::class, 'deleteAction'])->name('book.delete');
});
