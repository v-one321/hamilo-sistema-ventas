<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\DetalleComprasTemporalController;
use App\Http\Controllers\DetalleVentasTemporalController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
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
    return view('auth.login');
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
Route::delete('/compras/{id}', [ComprasController::class, 'destroy'])->name('compras.destroy');
Route::get('/compras/{id}', [ComprasController::class, 'show'])->name('compras.show');
/****************************       VENTAS    ************************************ */
Route::delete('/ventas/{id}', [VentasController::class, 'destroy'])->name('ventas.destroy');
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('/ventas/nuevo', [DetalleVentasTemporalController::class, 'inicio'])->name('ventas.store');
Route::get('ventas/agregar-carrito/{id}', [DetalleVentasTemporalController::class, 'agregarCarrito'])->name('ventas.agregar-carrito');
Route::get('/ventas/eliminar-carrito/{id}', [DetalleVentasTemporalController::class, 'eliminarCarrito'])->name('ventas.eliminar-carrito');
Route::get('/ventas/incrementar-carrito/{id}', [DetalleVentasTemporalController::class, 'incrementarCarrito'])->name('ventas.incrementar-carrito');
Route::get('/ventas/decrementar-carrito/{id}', [DetalleVentasTemporalController::class, 'decrementarCarrito'])->name('ventas.decrementar-carrito');
Route::post('/ventas', [DetalleVentasTemporalController::class, 'guardarCarrito'])->name('ventas.save');
Route::get('/ventas/{id}', [VentasController::class, 'show'])->name('ventas.show');
/***************************        USUARIO     ******************************* */
Route::get('/usuario', [UserController::class, 'edit'])->name('usuario.edit');
Route::post('/usuario', [UserController::class, 'editarDatos'])->name('usuario.editar-datos');
Route::post('/usuario-password', [UserController::class, 'modificarPassword' ])->name('usuario.editar-password');