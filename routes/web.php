<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('usuarios', UsuarioController::class )->middleware(['auth', 'verified'])->name('usuarios.index');

Route::get('register', [RegisteredUserController::class, 'create'])->middleware(['auth', 'verified'])->name('register');

Route::post('register', [RegisteredUserController::class, 'store'])->middleware(['auth', 'verified'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('roles', [RolController::class, 'index'])->name('roles.index');
    Route::post('roles', [RolController::class, 'store'])->name('roles.store');
    Route::put('roles/{id}', [RolController::class, 'update'])->name('roles.update');
    Route::delete('roles/{id}', [RolController::class, 'destroy'])->name('roles.destroy');

    Route::get('usuarios/{id}', [UsuarioController::class, 'edit'] )->name('usuarios.editar');
    Route::patch('usuarios/{id}', [UsuarioController::class, 'update'] )->name('usuarios.update');
    Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy'] )->name('usuarios.destroy');
});



Route::get('encuestas', function () {
    return Inertia::render('Encuestas/index');
})->middleware(['auth', 'verified'])->name('encuestas.index');

Route::get('encuestas/crear', function () {
    return Inertia::render('Encuestas/create');
})->middleware(['auth', 'verified'])->name('encuestas.create');

Route::post('encuestas/crear', function () {
    return Inertia::render('Encuestas/create');
})->middleware(['auth', 'verified'])->name('encuestas.store');



require __DIR__.'/auth.php';
