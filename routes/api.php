<?php

use App\Http\Controllers\TerrainController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/terrains', [TerrainController::class, 'index']);
    Route::get('/terrains/{id}', [TerrainController::class, 'show']);
    Route::post('/terrains', [TerrainController::class, 'store']);
    Route::put('/terrains/{id}', [TerrainController::class, 'update']);
});
