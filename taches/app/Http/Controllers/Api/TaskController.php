<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Lister toutes les tâches
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // Créer une nouvelle tâche
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'is_completed' => 'boolean',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // Afficher une tâche spécifique
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    // Mettre à jour une tâche
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'sometimes|date',
            'is_completed' => 'boolean',
        ]);

        $task->update($request->all());
        return response()->json($task);
    }

    // Supprimer une tâche
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}