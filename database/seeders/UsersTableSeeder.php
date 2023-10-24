<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        User::truncate();

        $password = Hash::make('12345678');

        User::factory()->create(
            [
                'name' => 'Administrator',
                'email' => 'admin@test.com',
                'password' => $password,
            ]
        );

        User::factory()->count(50)->create();
    }
}
