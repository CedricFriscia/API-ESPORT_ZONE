<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
      protected UserService $userService
    ) {
    }

    public function index()
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
        // Log l'erreur pour le débogage
        \Log::error('Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
        
        return response()->json([
            'status' => 'error',
            'message' => 'Une erreur est survenue lors de la récupération des utilisateurs.',
            'error_code' => $e->getCode()
        ], 500);
    }
}

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = $this->userService->create($data);

        return redirect()->route('users.show', $user->id);
    }

    public function show($id)
    {
        $user = $this->userService->find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'sometimes|confirmed'
        ]);

        $user = $this->userService->update($data, $id);

        return redirect()->route('users.show', $user->id);
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()->route('users.index');
    }
}