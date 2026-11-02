<?php

use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===== Route buku, dijaga permission Spatie =====
    Route::get('books', [BookController::class, 'index'])
        ->name('books.index')->middleware('permission:lihat-buku');

    Route::get('books/create', [BookController::class, 'create'])
        ->name('books.create')->middleware('permission:tambah-buku');
    Route::post('books', [BookController::class, 'store'])
        ->name('books.store')->middleware('permission:tambah-buku');

    Route::get('books/{book}/edit', [BookController::class, 'edit'])
        ->name('books.edit')->middleware('permission:edit-buku');
    Route::put('books/{book}', [BookController::class, 'update'])
        ->name('books.update')->middleware('permission:edit-buku');

    Route::delete('books/{book}', [BookController::class, 'destroy'])
        ->name('books.destroy')->middleware('permission:hapus-buku');

        Route::get('users', [UserRoleController::class, 'index'])
        ->name('users.index')->middleware('permission:kelola-role');
    Route::patch('users/{user}/role', [UserRoleController::class, 'update'])
        ->name('users.role')->middleware('permission:kelola-role');
});

require __DIR__.'/auth.php';