<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->saveUser($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'register success',
            'data' => new UserResource($user)
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth()->guard('api')->attempt($request->validated())) {
            return response()->json([
                'message' => "Email or Password is incorrect"
            ], 401);
        };
        return response()->json([
            'status' => 'success',
            'message' => 'login success',
            'user' => auth()->guard('api')->user(),
            'token' => $token,
        ], 200);
    }

    public function logout()
    {
        //remove token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if ($removeToken) {
            //return response JSON
            return response()->json([
                'message' => 'Logout Success!',
            ]);
        }
    }
}
