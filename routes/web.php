<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login_inicio');
})->name('inicio');;

Route::get('productos', [ProductoController::class, 'index'])->name('productos');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::post('auth', [LoginController::class, 'login'])->name('auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('agregar', [CarritoController::class, 'agregar'])->name('agregar');
Route::post('eliminar', [CarritoController::class, 'eliminar'])->name('eliminar');
Route::get('ver', [CarritoController::class, 'ver'])->name('carrito');

Route::get('orden', [OrdenController::class, 'index'])->name('orden');

Route::post('generar-orden', [OrdenController::class, 'generarOrden'])->name('generar-orden');



