<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ClientesController;
use App\Http\Controllers\api\ComprasController;
use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\ProductosController;
use App\Http\Controllers\api\ProveedoresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(["middleware" => "auth:sanctum"], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    /****************       PROVEEDORES     ******************************** */
    Route::get('/proveedores', [ProveedoresController::class, 'index']);
    Route::post('/proveedores', [ProveedoresController::class, 'store']);
    Route::get('/proveedores/{id}', [ProveedoresController::class, 'show']);
    Route::delete('/proveedores/{id}', [ProveedoresController::class, 'destroy']);
    Route::put('/proveedores/{id}', [ProveedoresController::class, 'update']);
    /****************       CLIENTES     ******************************** */
    Route::get('/clientes', [ClientesController::class, 'index']);
    Route::post('/clientes', [ClientesController::class, 'store']);
    Route::get('/clientes/{id}', [ClientesController::class, 'show']);
    Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);
    Route::put('/clientes/{id}', [ClientesController::class, 'update']);
    /****************       PRODUCTOS     ******************************** */
    Route::get('/productos', [ProductosController::class, 'index']);
    Route::post('/productos', [ProductosController::class, 'store']);
    Route::get('/productos/{id}', [ProductosController::class, 'show']);
    Route::delete('/productos/{id}', [ProductosController::class, 'destroy']);
    Route::put('/productos/{id}', [ProductosController::class, 'update']);
    /******************     RUTAS ACTIVAS ********************************* */
    Route::get('/productos-activos', [ProductosController::class, 'productosActivos']);
    Route::get('/clientes-activos', [ClientesController::class, 'clientesActivos']);
    Route::get('/proveedores-activos', [ProveedoresController::class, 'proveedoresActivos']);
    /*******************    COMPRAS             *************************** */
    Route::get('/compras', [ComprasController::class, 'index']);
    Route::post('/compras', [ComprasController::class, 'store']);
    Route::get('/compras/{id}', [ComprasController::class, 'show']);
    Route::delete('/compras/{id}', [ComprasController::class, 'destroy']);
    /******************     DASHBOARD   ******************************* */
    Route::get('/dashboard', [DashboardController::class, 'inicio']);
});

Route::post('/login', [AuthController::class, 'login']);