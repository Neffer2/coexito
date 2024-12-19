<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;

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

//Endpoints for the API
Route::get('/get-agente/{documento?}', [InfoController::class, 'getAgente']);
Route::get('get-punto-venta/{nit?}', [InfoController::class, 'getPuntoVenta']);
Route::get('get-recomendador/{documento?}', [InfoController::class, 'getRecomendador']);
Route::post('set-recomendador', [InfoController::class, 'setRecomendador']);
Route::post('registro-servicio', [InfoController::class, 'registratServicio']);

// Validaciones
Route::get('validate-cedula/{cedula}/{rol}', [InfoController::class, 'validateCedula']);
Route::get('validate-celular/{celular}/{rol}', [InfoController::class, 'validateCelular']);
Route::get('validate-correo/{correo}/{rol}', [InfoController::class, 'validateCorreo']);
