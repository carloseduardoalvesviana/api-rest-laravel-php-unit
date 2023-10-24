<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function test_create_article(): void
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $token = $user->createToken($user->email)->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $data = ['title' => 'test title', 'body' => 'test body'];
        $response = $this->json('POST', 'api/articles', $data, $headers);

        $response->assertStatus(201);

        $response->assertJson(['id' => 1, 'title' => 'test title', 'body' => 'test body']);
    }

    public function test_update_article(): void
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $token = $user->createToken($user->email)->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $article = Article::factory()->create(['title' => 'test title', 'body' => 'test body'])->first();

        $data = ['title' => 'test title updated', 'body' => 'test body updated'];
        $response = $this->json('PUT', 'api/articles/'.$article->id, $data, $headers);

        $response->assertStatus(200);

        $response->assertJson(['title' => 'test title updated', 'body' => 'test body updated']);
    }

    public function test_delete_article(): void
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $token = $user->createToken($user->email)->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $article = Article::factory()->create(['title' => 'test title', 'body' => 'test body'])->first();

        $article->delete();

        $response = $this->json('GET', 'api/articles/'.$article->id, [], $headers);

        $response->assertStatus(404);
    }

    public function test_list_article(): void
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $token = $user->createToken($user->email)->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        Article::factory()->count(50)->create();

        $response = $this->json('GET', 'api/articles/', [], $headers);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
        ]);
    }
}
