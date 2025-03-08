<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Lister tous les posts
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Afficher un post spécifique
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // Créer un nouveau post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    // Mettre à jour un post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($request->all());
        return response()->json($post);
    }

    // Supprimer un post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}