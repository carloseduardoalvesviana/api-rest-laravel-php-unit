<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_required_fields(): void
    {
        $this->json('POST', 'api/login', [])
            ->assertStatus(422)
            ->assertJsonFragment([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function test_login_successfully(): void
    {
        User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $payload = ['email' => 'test@gmail.com', 'password' => '12345678'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token' => [],
            ]);
    }
}
