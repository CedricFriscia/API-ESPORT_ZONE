<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUsers()
{
    try {
        $users = $this->userService->getAllUsers();
        
        return response()->json([
            'status' => 'success',
            'data' => $users,
            'total_count' => $users->count(),
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

public function getOneUser(Request $request)
{
    $userId = $request->input('user_id');

    try {
        $user = $this->userService->getOneUser($userId);
        
        return response()->json([
            'status' => 'success',
            'data' => $user,
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

public function deleteUser(Request $request)
{
    $userId = $request->input('user_id');

    try {
        $user = $this->userService->deleteUser( $userId);
        
        return response()->json([
            'status' => 'success',
            'data' => $user,
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

public function updateUser(Request $request)
{
    $userId = $request->input('user_id');

    $data = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
    ]);

    try {
        $user = $this->userService->updateUser( $data, $userId);
        
        return response()->json([
            'status' => 'success',
            'data' => $user,
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

public function getUserProfile(Request $request)
{
    $userId = Auth::user()->id;

    try {
        $user = $this->userService->getOneUser($userId);
        
        return response()->json([
            'status' => 'success',
            'data' => $user,
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

   
}