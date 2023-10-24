<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_register_required_fields(): void
    {
        $data = [];

        $this->json('POST', 'api/register', $data)
            ->assertStatus(422)
            ->assertJsonFragment([
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function test_register_successfully(): void
    {
        $data = [
            'name' => 'John',
            'email' => 'john@test.com',
            'password' => '12345678',
        ];

        $this->json('POST', 'api/register', $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ]);
    }
}
