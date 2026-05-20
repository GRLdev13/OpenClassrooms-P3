<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Controllers\Index\IndexController;
use App\Controllers\Notes\NotesController;
use App\Controllers\Tags\TagsController;
use App\Controllers\User\UserController;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/login', [IndexController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login'])->middleware(['guest']);
Route::post('/logout', [UserController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
    Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::delete('/notes/{note}', [NotesController::class, 'destroy'])->name('notes.destroy');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Route::get('/items', [NotesController::class, 'index']);
// Route::get('/items/{id}', [NotesController::class, 'show']);
// Route::post('/items', [NotesController::class, 'store']);
// Route::put('/items/{id}', [NotesController::class, 'update']);
// Route::delete('/items/{id}', [NotesController::class, 'destroy']);
