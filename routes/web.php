<?php

define('LOGIN_ROUTE', '/login');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect(LOGIN_ROUTE);
});

Route::get(LOGIN_ROUTE, [AuthController::class, 'showLoginForm'])->name('login');
Route::post(LOGIN_ROUTE, [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('categorias', CategoriaProductoController::class);
    Route::resource('productos', ProductoController::class);
});
