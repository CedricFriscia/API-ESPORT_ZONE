<?php 

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getAllUser();

    public function updateUser(array $data, int $id);

    public function deleteUser(int $userId);

    public function getOneUser(int $userId);
}