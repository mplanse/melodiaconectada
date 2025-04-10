<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\MultimediaController;
use App\Http\Controllers\EventoController;



use App\Http\Controllers\api\ContratoController;


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

Route::get('/getEventos', [EventoController::class, 'getEventos'])->name('eventos.getEventos');

Route::get('musicos-restaurantes', [ContratoController::class, 'obtenerMusicosYRestaurantes']);


Route::get('musicos-restaurantes', [ContratoController::class, 'obtenerMusicosYRestaurantes']);

Route::get('/obtener-direcciones', [MapController::class, 'obtenerDirecciones']);

Route::get('/recibir-imagen', [MultimediaController::class, 'getUserImages']);
Route::post('/guardar-imagen', [MultimediaController::class, 'store']);

