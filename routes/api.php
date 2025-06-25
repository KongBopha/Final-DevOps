<?php

use App\Http\Controllers\TerrainController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::apiResource('terrains', TerrainController::class);
Route::apiResource('bookings', BookingController::class)->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('terrains/{terrain}/favorite', [TerrainController::class, 'favorite']);
    Route::delete('terrains/{terrain}/favorite', [TerrainController::class, 'unfavorite']);
});
