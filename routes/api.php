<?php

use App\Http\Controllers\AdresseController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ContribuableController;
use App\Http\Controllers\PaimentIprController;
use App\Http\Controllers\TauxImposambleController;
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

Route::post('register', [UserController::class, 'register']);

Route::post('login',[UserController::class, 'login'] );

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('adresse', AdresseController::class);
    Route::apiResource('contribuable', ContribuableController::class);
    Route::apiResource('employe', EmployeController::class);
    Route::apiResource('paiment-ipr', PaimentIprController::class);
    Route::get('generate_ipr', [PaimentIprController::class, 'generate_ipr']);
    Route::apiResource('taux-imposamble', TauxImposambleController::class);
});
