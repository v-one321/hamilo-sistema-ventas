<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\DetalleComprasTemporalController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/****************************       CLIENTES    ************************************ */
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/nuevo', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');
Route::get('/clientes/{id}', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClientesController::class, 'update'])->name('clientes.update');
/****************************       PROVEEDORES    ************************************ */
Route::get('/proveedores', [ProveedoresController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/nuevo', [ProveedoresController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedoresController::class, 'store'])->name('proveedores.store');
Route::delete('/proveedores/{id}', [ProveedoresController::class, 'destroy'])->name('proveedores.destroy');
Route::get('/proveedores/{id}', [ProveedoresController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{id}', [ProveedoresController::class, 'update'])->name('proveedores.update');
/****************************       PRODUCTOS    ************************************ */
Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/productos/nuevo', [ProductosController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
Route::delete('/productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
Route::get('/productos/{id}', [ProductosController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
/****************************       COMPRAS    ************************************ */
Route::get('/compras/nuevo', [DetalleComprasTemporalController::class, 'inicio'])->name('compras.store');
Route::get('compras/agregar-carrito/{id}', [DetalleComprasTemporalController::class, 'agregarCarrito'])->name('compras.agregar-carrito');
Route::get('/compras/eliminar-carrito/{id}', [DetalleComprasTemporalController::class, 'eliminarCarrito'])->name('compras.eliminar-carrito');
Route::get('/compras/incrementar-carrito/{id}', [DetalleComprasTemporalController::class, 'incrementarCarrito'])->name('compras.incrementar-carrito');
Route::get('/compras/decrementar-carrito/{id}', [DetalleComprasTemporalController::class, 'decrementarCarrito'])->name('compras.decrementar-carrito');
Route::post('/compras', [DetalleComprasTemporalController::class, 'guardarCarrito'])->name('compras.save');
Route::get('/compras', [ComprasController::class, 'index'])->name('compras.index');