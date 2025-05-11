<?php

use App\Http\Controllers\API\RegisterUserController;
use App\Http\Controllers\API\RutaController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ZonesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [RegisterUserController::class, 'register']);
Route::post('/zonas', [ZonesController::class, 'listar']);

Route::post('/ruta', [RutaController::class, 'ruta'])->middleware('auth:sanctum');
Route::post('/programacion/list', [RutaController::class, 'consultarrutas'])->middleware('auth:sanctum');
Route::post('/obtenerzona', [ZonesController::class, 'obtenerzona'])->middleware('auth:sanctum');
Route::post('/rutahoy', [RutaController::class, 'rutahoy'])->middleware('auth:sanctum');