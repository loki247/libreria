<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibroTomoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('libros')->group(function () {
        Route::get('/', [LibroController::class, 'getAll']);
        Route::post('/', [LibroController::class, 'save']);
        Route::put('/', [LibroController::class, 'update']);
        Route::get('/{id}', [LibroController::class, 'getById']);

        Route::prefix('tomos')->group(function () {
            Route::get('/{id}', [LibroTomoController::class, 'getById']);
        });
    });
});
