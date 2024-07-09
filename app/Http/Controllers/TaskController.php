<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList; // Importe le modèle TodoList
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Affiche la liste de toutes les tâches.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Enregistre une nouvelle tâche.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:not_started,in_progress,completed',
            'echeance' => 'nullable|date',
            'todo_list_id' => 'required|exists:todo_lists,id', // Vérifie que l'ID de la TodoList existe
        ]);

        // Récupère la TodoList à partir de l'ID fourni
        $todoList = TodoList::findOrFail($validatedData['todo_list_id']);

        // Crée la tâche en l'associant à la TodoList
        $task = $todoList->tasks()->create($validatedData);

        return response()->json(['message' => 'Tâche créée avec succès', 'task' => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Retourner la tâche spécifique au format JSON
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:not_started,in_progress,completed',
            'echeance' => 'nullable|date',
        ]);

        // Vérifier si la tâche existe
        if (!$task) {
            return response()->json(['message' => 'Tâche non trouvée'], 404);
        }

        // Mettre à jour la tâche avec les nouvelles données
        $task->nom = $validatedData['nom'];
        $task->description = $validatedData['description'];
        $task->status = $validatedData['status'];
        $task->echeance = $validatedData['echeance'];

        // Enregistrer les modifications
        $task->save();

        // Retourner la tâche mise à jour au format JSON
        return response()->json(['message' => 'Tâche mise à jour avec succès', 'task' => $task]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Supprimer la tâche
        $task->delete();

        // Retourner une réponse JSON indiquant le succès (vous pouvez personnaliser le message)
        return response()->json(['message' => 'Tâche supprimée avec succès']);
    }
}
