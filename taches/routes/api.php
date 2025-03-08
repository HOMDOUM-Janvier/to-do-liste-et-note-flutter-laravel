<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController; // Exemple de contrôleur pour une ressource
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\NoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Routes pour les tâches
Route::apiResource('tasks', TaskController::class);


// Routes pour les notes
Route::apiResource('notes', NoteController::class);


// Routes publiques (sans authentification)
Route::post('/login', [AuthController::class, 'login']); // Connexion
Route::post('/register', [AuthController::class, 'register']); // Inscription

// Routes protégées par Sanctum (authentification requise)
Route::middleware('auth:sanctum')->group(function () {
    // Routes pour l'authentification
    Route::get('/user', [AuthController::class, 'user']); // Récupérer l'utilisateur authentifié
    Route::post('/logout', [AuthController::class, 'logout']); // Déconnexion

    // Routes pour la gestion des utilisateurs
    Route::get('/users', [UserController::class, 'index']); // Lister tous les utilisateurs
    Route::get('/users/{id}', [UserController::class, 'show']); // Afficher un utilisateur spécifique
    Route::put('/users/{id}', [UserController::class, 'update']); // Mettre à jour un utilisateur
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur

    // Routes pour une ressource exemple (posts)
    Route::get('/posts', [PostController::class, 'index']); // Lister tous les posts
    Route::get('/posts/{id}', [PostController::class, 'show']); // Afficher un post spécifique
    Route::post('/posts', [PostController::class, 'store']); // Créer un nouveau post
    Route::put('/posts/{id}', [PostController::class, 'update']); // Mettre à jour un post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // Supprimer un post
});