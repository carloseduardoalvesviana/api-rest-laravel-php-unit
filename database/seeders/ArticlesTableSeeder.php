<?php

namespace Database\Seeders;

use App\Models\Article;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Article::truncate();

        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'title' => fake()->sentence(),
                'body' => fake()->paragraph(),
            ]);
        }
    }
}
