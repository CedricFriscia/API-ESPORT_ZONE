<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function updateUser(array $data, $id)
    {
        return $this->userRepository->updateUser($data, $id);
    }

    public function deleteUser(int $userId)
    {
        return $this->userRepository->deleteUser($userId);
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }
    
    public function getOneUser(int $userId)
    {
        return $this->userRepository->getOneUser($userId);
    }
}
