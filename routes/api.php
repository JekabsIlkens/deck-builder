<?php

use App\Enums\PermissionsEnum;
use Illuminate\Support\Facades\Route;

// Get Bearer Token

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Delete Bearer Token

    Route::group(['middleware' => ['permission:'.PermissionsEnum::MANAGE_USERS->value]], function () {
        // Users CRUD
    });

    Route::group(['middleware' => ['permission:'.PermissionsEnum::MANAGE_DECKS->value]], function () {
        // Decks CRUD
    });
});
