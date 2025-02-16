<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

Route::post('/tokens', [TokenController::class, 'store'])
    ->middleware('throttle:5,1');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::delete('/tokens', [TokenController::class, 'destroy']);

    Route::group(['middleware' => ['permission:manage_users']], function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
    });

    Route::group(['middleware' => ['permission:manage_decks']], function () {
        // Decks CRUD
    });
});
