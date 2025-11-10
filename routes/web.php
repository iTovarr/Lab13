<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/notas', [NotaController::class, 'index'])->name('notas.index');

Route::post('/notas', [NotaController::class, 'store'])->name('notas.store');
