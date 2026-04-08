<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua route di bawah ini hanya bisa diakses jika user sudah LOGIN
Route::middleware('auth')->group(function () {
    
    // Route Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route To-Do List (Fitur Kamu)
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::patch('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
Route::put('/todos/{todo}/update-task', [TodoController::class, 'updateTask'])->name('todos.update-task');
});

require __DIR__.'/auth.php';