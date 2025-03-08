<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Lister toutes les notes
    public function index()
    {
        $notes = Note::all();
        return response()->json($notes);
    }

    // Créer une nouvelle note
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = Note::create($request->all());
        return response()->json($note, 201);
    }

    // Afficher une note spécifique
    public function show($id)
    {
        $note = Note::findOrFail($id);
        return response()->json($note);
    }

    // Mettre à jour une note
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $note->update($request->all());
        return response()->json($note);
    }

    // Supprimer une note
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json(['message' => 'Note deleted successfully']);
    }
}