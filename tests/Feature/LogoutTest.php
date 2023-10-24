<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function test_logout_successfully(): void
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $token = $user->createToken($user->email)->plainTextToken;

        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('POST', 'api/logout', [], $headers);

        $response->assertStatus(204);
    }
}
