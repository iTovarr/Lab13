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

// Rutas de Actividades (¡ESTA ES LA LÍNEA MODIFICADA!)
Route::resource('actividades', ActividadController::class)->parameters(['actividades' => 'actividad']);

// Ruta de Toggle (Esta ya la tenías y está bien)
Route::patch('/actividades/{actividad}/toggle', [ActividadController::class, 'toggleComplete'])->name('actividades.toggle');