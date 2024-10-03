<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Routas;
use App\Http\Controllers\NotasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('notas/lista', [NotasController::class, 'lista']); 
Route::put('notas/actualizar/{id}', [NotasController::class, 'actualizar']); 
Route::get('notas/data-id/{id}', [NotasController::class, 'dataId']); 
Route::post('notas/registrar', [NotasController::class, 'registrar']); 
Route::delete('notas/eliminar/{id}', [NotasController::class, 'eliminar']); 