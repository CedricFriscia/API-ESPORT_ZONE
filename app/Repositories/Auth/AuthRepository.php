<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $data)
    {
        $credentials = [
            'name' => $data['name'],
            'password' => $data['password']
        ];
    
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'message' => ['Les informations de connexion sont incorrectes.'],
            ]);
        }
    
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return [
            'user' => $user,
            'access_token' => $token,
        ];
    }

    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}