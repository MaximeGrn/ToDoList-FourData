<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});
// Route préfixée par /api/tasks pour plus de clarté
Route::prefix('/api')->group(function () { // <-- Juste /api
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    // ... les autres routes (show, update, destroy) seront ajoutées plus tard ...
});
// ... autres routes ...

Route::apiResource('/api/todo-lists', TodoListController::class);
Route::get('/test', function () {
    return 'Test du fonctionnement des routes';
});
