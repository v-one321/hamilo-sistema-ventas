<?php

use App\Http\Controllers\api\AuthController;
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
});

Route::post('/login', [AuthController::class, 'login']);