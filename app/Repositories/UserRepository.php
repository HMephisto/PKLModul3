<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
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
        return $this->users::oldest("id")->get();
    }

    public function getUserById($id)
    {
        return $this->users::findorfail($id);
    }

    public function createUser($userDetails)
    {
        return $this->users::create([
            "name" => $userDetails["name"],
            "email" => $userDetails["email"],
            "password" => bcrypt($userDetails["password"]),
        ]);
    }

    public function updateUser($newDetails, $id)
    {
        return $this->users::where('id', $id)->update($newDetails);
    }

    public function deleteUser($id)
    {
        $this->users::where('id', $id)->delete();
    }
}
