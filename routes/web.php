<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});
// Route préfixée par /api/tasks pour plus de clarté
Route::prefix('/api')->group(function () { // <-- Juste /api
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    // ... les autres routes (show, update, destroy) seront ajoutées plus tard ...
});
Route::get('/test', function () {
    return 'Test du fonctionnement des routes';
});
