<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null;
    }

    public function register(array $data)
    {
        try {
            // Vérifier si l'email existe déjà
            if (User::where('email', $data['email'])->exists()) {
                throw new \Exception('Un utilisateur avec cet email existe déjà.');
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return $user;
        } catch (QueryException $e) {
            // Gérer les erreurs de base de données
            throw new \Exception('Une erreur est survenue lors de l\'enregistrement.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }
}