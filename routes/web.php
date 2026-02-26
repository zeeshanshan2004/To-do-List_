<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
Route::get('/', [BoardController::class, 'index'])->name('board.index');
Route::get('/cards/create/{listId}', [BoardController::class, 'create'])->name('cards.create');
Route::post('/cards', [BoardController::class, 'store'])->name('cards.store');

// Naye Action Routes
Route::post('/cards/{id}/move', [BoardController::class, 'move'])->name('cards.move');
Route::delete('/cards/{id}', [BoardController::class, 'destroy'])->name('cards.destroy');
Route::get('/cards/{id}/edit', [BoardController::class, 'edit'])->name('cards.edit');
Route::put('/cards/{id}', [BoardController::class, 'update'])->name('cards.update');
