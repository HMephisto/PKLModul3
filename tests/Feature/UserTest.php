<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_register()
    {
        $payload = [
            "name" => "user",
            "email" => fake()->unique()->safeEmail(),
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->postJson('api/register/', $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "id",
                    "name",
                    "email",
                    "created_at",
                    "updated_at"
                ]
            ]);
    }

    public function test_user_login()
    {
        $user = User::factory()->create();
        $response = $this->post('api/login/', [
            "email" => $user->email,
            "password" => "password"
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "user" => [
                        "id",
                        "name",
                        "email",
                        "created_at",
                        "updated_at"
                    ],
                    "token"
                ]
            ]);
    }

    public function test_user_login_fail()
    {
        $user = User::factory()->create();
        $response = $this->post('api/login/', [
            "email" => $user->email,
            "password" => "abcdefghij"
        ]);
        $response->assertStatus(401)
            ->assertJson([
                'message' => "Email or Password is incorrect"
            ]);
    }

    public function test_user_detail()
    {
        $user = User::factory()->create();
        $token = auth()->guard('api')->attempt(['email' => $user->email,  'password' => 'password']);
        $headers["Accept"] = "application/json";
        $headers["Authorization"] = "Bearer " . $token;

        $response = $this->get('api/user/', $headers);
        $response->assertStatus(200)
            ->assertJsonStructure([
                "id",
                "name",
                "email",
                "created_at",
                "updated_at"
            ]);
    }

    public function test_user_logout()
    {
        $user = User::factory()->create();
        $token = auth()->guard('api')->attempt(['email' => $user->email,  'password' => 'password']);
        $headers["Accept"] = "application/json";
        $headers["Authorization"] = "Bearer " . $token;

        $response = $this->post('/api/logout/', [], $headers);
        $response->assertStatus(200)
            ->assertJson([
                "message" => "Logout Success!",
            ]);
    }
}
