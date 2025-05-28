<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'image' => 'gps.jpg',
            'name' => 'Test User',
            'id_lokets' => '1',
            'email' => 'adellana@example.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'image' => 'rara.jpg',
            'name' => 'Rara',
            'id_lokets' => 1,
            'email' => 'rara@example.com',
            'role' => 'user',
            'password' => Hash::make('123456'),
        ]);

    }
}
