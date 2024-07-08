<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Route préfixée par /api/tasks pour plus de clarté
Route::prefix('/api/tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'store']);
    // ... les autres routes (show, update, destroy) seront ajoutées plus tard ...
});
