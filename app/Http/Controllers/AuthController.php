<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->all();
            
            return response()->json([
                'status' => 'success',
                'data' => $users,
                'total_count' => $users->count(),
                'version' => '1.0'
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des utilisateurs.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed'
            ]);

            $user = $this->userService->create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Utilisateur créé avec succès',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de l\'utilisateur: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la création de l\'utilisateur.',
                'error_code' => $e->getCode()
            ], 422);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $user = $this->userService->find($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération de l\'utilisateur: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Utilisateur non trouvé.',
                'error_code' => $e->getCode()
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$id,
                'password' => 'sometimes|required|string|min:8|confirmed'
            ]);

            $user = $this->userService->update($data, $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Utilisateur mis à jour avec succès',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la mise à jour de l\'utilisateur: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour de l\'utilisateur.',
                'error_code' => $e->getCode()
            ], 422);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->userService->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Utilisateur supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la suppression de l\'utilisateur.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }
}