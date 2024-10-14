<?php

namespace App\Services;

use App\Repositories\Auth\AuthRepositoryInterface;

class AuthService
{
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {
    }

    public function login(array $data) {
        return $this->authRepository->login($data);
    }

    public function register(array $data) {
        return $this->authRepository->register($data);
    }

}
