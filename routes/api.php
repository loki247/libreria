<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LecturaLibroController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibroTomoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('libros')->group(function () {
        Route::get('/', [LibroController::class, 'getAll']);
        Route::get('/libros', [LibroController::class, 'getLibros']);
        Route::get('/mangas', [LibroController::class, 'getMangas']);
        Route::post('/', [LibroController::class, 'save']);
        Route::put('/', [LibroController::class, 'update']);
        Route::get('/{id}', [LibroController::class, 'getById']);

        Route::prefix('tomos')->group(function () {
            Route::get('/{id}', [LibroTomoController::class, 'getById']);
        });
    });

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/{username}', [UserController::class, 'getByUsername']);

    Route::prefix('lecturas')->group(function () {
        Route::get('/{idUsuario}', [LecturaLibroController::class, 'getByUsuario']);
        Route::get('/{idTomo}/{idUsuario}', [LecturaLibroController::class, 'getByIdTomoUsuario']);
        Route::post('/', [LecturaLibroController::class, 'saveLectura']);
        Route::put('/', [LecturaLibroController::class, 'updateLectura']);
    });
});
