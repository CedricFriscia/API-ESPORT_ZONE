<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'password' => 'required'
    ]);

    try {
        $loginData = $this->authService->login($data);
        
        return response()->json([
            'status' => 'success',
            'user' => $loginData['user'],
            'access_token' => $loginData['access_token'],
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Error during login: ' . $e->getMessage());
        
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred during login.',
            'error_code' => $e->getCode()
        ], 500);
    }
}

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $user = $this->authService->register($data);
            
            return response()->json([
                'status' => 'success',
                'data' => $user,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid registration data',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error during registration: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during registration.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request->user());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        } catch (\Exception $e) {
            \Log::error('Error during logout: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during logout.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }
}