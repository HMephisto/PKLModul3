<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUser();
    public function getUserById($id);
    public function createUser(array $UserDetails);
    public function updateUser(array $newDetails, $id);
    public function deleteUser($id);
}