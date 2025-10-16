<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categorias', CategoriaProductoController::class);
Route::resource('productos', ProductoController::class);
