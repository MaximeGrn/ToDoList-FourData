<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $todoLists = TodoList::all();
        return response()->json($todoLists);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $todoList = TodoList::create($validatedData);

        return response()->json(['message' => 'ToDoList créée avec succès', 'todoList' => $todoList], 201);
    }

    public function show(TodoList $todoList)
    {
        // Charge explicitement la relation 'tasks'
        $todoList->load('tasks');

        return response()->json($todoList);
    }

    public function update(Request $request, TodoList $todoList)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $todoList->update($validatedData);

        return response()->json(['message' => 'ToDoList mise à jour avec succès', 'todoList' => $todoList]);
    }

    public function destroy(TodoList $todoList)
    {
        $todoList->delete();

        return response()->json(['message' => 'ToDoList supprimée avec succès']);
    }
}
