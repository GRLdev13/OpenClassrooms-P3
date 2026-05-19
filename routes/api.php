<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\Index\IndexController;
use App\Controllers\Notes\NotesController;

Route::get('/', [IndexController::class, 'index']);
// Route::get('/user/login', [UserController::class, 'login']);


// Route::get('/items', [NotesController::class, 'index']);
// Route::get('/items/{id}', [NotesController::class, 'show']);
// Route::post('/items', [NotesController::class, 'store']);
// Route::put('/items/{id}', [NotesController::class, 'update']);
// Route::delete('/items/{id}', [NotesController::class, 'destroy']);
