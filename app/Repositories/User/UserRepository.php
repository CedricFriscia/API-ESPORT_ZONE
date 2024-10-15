<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUser(): Collection
    {
        return User::all();
    }

    public function getOneUser(int $userId): ?User
    {
        return User::find($userId);
    }

    public function updateUser(array $data, int $id): ?User
    {
        $user = $this->getOneUser($id);

        if (!$user) {
            return null;
        }

        $user->update($data);
        return $user->fresh();
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->getOneUser($id);

        if (!$user) {
            return false;
        }

        return $user->delete();
    }
}