<?php

use App\Models\Contrato;
use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\MultimediaController;



use App\Http\Controllers\api\ContratoController;
use App\Http\Controllers\Api\RestauranteController;

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


Route::apiResource('contrato', ContratoController::class);

Route::get('/obtener-coordenadas', [MapController::class, 'obtenerCoordenadas']);

<<<<<<< HEAD
Route::get('musicos-restaurantes', [ContratoController::class, 'obtenerMusicosYRestaurantes']);


Route::get('musicos-restaurantes', [ContratoController::class, 'obtenerMusicosYRestaurantes']);
=======
// Route::get('/obtener-direcciones', [MapController::class, 'obtenerDirecciones']);

// Route::get('/recibir-imagen', [MultimediaController::class, 'getUserImages']);
// Route::post('/guardar-imagen', [MultimediaController::class, 'store']);

>>>>>>> 11347ca399c8d0171bd81cb9d6208f8a8f52c067
