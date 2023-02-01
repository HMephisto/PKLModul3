<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $users;

    public function __construct()
    {
        $this->users = new User();
    }
    public function getAllUser()
    {
        return $this->users::orderBy("id", "ASC")->get();
    }

    public function getUserById($id)
    {
        return $this->users::findorfail($id);
    }

    public function createUser($userDetails)
    {
        $this->users::create($userDetails);
    }

    public function updateUser($newDetails, $id)
    {
        $this->users::where('id', $id)->update($newDetails);
    }

    public function deleteUser($id)
    {
        $this->users::where('id', $id)->delete();
    }
}
