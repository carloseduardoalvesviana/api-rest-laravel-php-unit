<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    public function test_unauthorized_user(): void
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $token = $user->createToken($user->email)->plainTextToken;

        $headers = ['Authorization' => "Bearer $token"];

        $user->tokens()->delete();

        $response = $this->json('GET', 'api/me', [], $headers);

        $response->assertStatus(401);
    }
}
