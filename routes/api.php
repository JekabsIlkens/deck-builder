<?php

use App\Enums\PermissionsEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

Route::post('/tokens', [TokenController::class, 'store'])->middleware('throttle:5,1');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::delete('/tokens', [TokenController::class, 'destroy']);

    Route::group(['middleware' => ['permission:'.PermissionsEnum::MANAGE_USERS->value]], function () {
        // Users CRUD
    });

    Route::group(['middleware' => ['permission:'.PermissionsEnum::MANAGE_DECKS->value]], function () {
        // Decks CRUD
    });
});
