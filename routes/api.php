<?php

use App\Http\Controllers\ClientController;
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

// // Ruta para obtener la lista de clientes
// Route::get('/clients', [ClientController::class, 'index']);
// // Puedes agregar más rutas según las necesidades de tu API
// Route::post('/clients', [ClientController::class, 'store']);
// Route::get('/clients/{id}', [ClientController::class, 'show']);
// Route::put('/clients/{id}', [ClientController::class, 'update']);
// Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

// Definir rutas usando apiResource
Route::apiResource('clients', ClientController::class);
