<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function saveUser($request)
    {
        $this->users::create([
            "name" => $request['name'],
            "email" => $request['email'],
            "password" => Hash::make( $request['password']) ,
        ]);
    }
}
