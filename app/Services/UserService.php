<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function saveUser($request)
    {
        return $this->userRepo->createUser($request);
    }
}
