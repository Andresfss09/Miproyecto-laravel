<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar todas las rutas web de tu aplicación.
| Estas rutas se cargan por el RouteServiceProvider y todas
| estarán dentro del grupo de middleware "web".
|
*/

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (solo usuarios autenticados y verificados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas (solo para usuarios logueados)
Route::middleware('auth')->group(function () {

    // CRUD de productos protegido
    Route::resource('products', ProductController::class);

    // Rutas del perfil del usuario (ya creadas por Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Archivo de rutas de autenticación (login, register, logout, etc.)
require __DIR__.'/auth.php';
