<?php

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


Route::apiResource('adresse', App\Http\Controllers\AdresseController::class);

Route::apiResource('contribuable', App\Http\Controllers\ContribuableController::class);


Route::apiResource('employe', App\Http\Controllers\EmployeController::class);


Route::apiResource('paiment-ipr', App\Http\Controllers\PaimentIprController::class);


Route::apiResource('taux-imposamble', App\Http\Controllers\TauxImposambleController::class);
