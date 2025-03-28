<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\RestauranteController;
use App\Http\Controllers\EventoController;
use App\Models\Restaurante;

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

Route::apiResource('mapa', MapController::class);


Route::apiResource('Restaurante', RestauranteController::class);

Route::get('/obtener-coordenadas', [MapController::class, 'obtenerCoordenadas']);
