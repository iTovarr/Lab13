<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\ActividadController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// Rutas de Notas
Route::resource('notas', NotaController::class);

// CRUD Actividades usando solo IDs
Route::get('/actividades/create', [ActividadController::class, 'create'])->name('actividades.create');
Route::post('/actividades', [ActividadController::class, 'store'])->name('actividades.store');
Route::get('/actividades/{id}/edit', [ActividadController::class, 'edit'])->name('actividades.edit');
Route::put('/actividades/{id}', [ActividadController::class, 'update'])->name('actividades.update');
Route::delete('/actividades/{id}', [ActividadController::class, 'destroy'])->name('actividades.destroy');

// Toggle completar
Route::patch('/actividades/{id}/toggle', [ActividadController::class, 'toggleComplete'])->name('actividades.toggle');
