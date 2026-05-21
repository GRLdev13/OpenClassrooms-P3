<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Controllers\Index\IndexController;
use App\Controllers\Notes\NotesController;
use App\Controllers\Tags\TagsController;
use App\Controllers\User\UserController;

//TODO Guard for redirect
// https://laravel.com/docs/13.x/routing#the-default-route-files
//check: Laravel sanctum

Route::middleware(['guest'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/login', [IndexController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.store');
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.store');
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
    Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::delete('/notes/{note}', [NotesController::class, 'destroy'])->name('notes.destroy');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
    Route::post('/user/password', [UserController::class, 'updatePassword'])->name('password');
});


//example route with parameters:
// Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings.profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
