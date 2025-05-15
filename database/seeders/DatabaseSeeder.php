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
        User::factory(10)->create();

        // User::factory()->create([
        //     'image' => 'gps.jpg',
        //     'name' => 'Test User',
        //     'email' => 'adellana@example.com',
        //     'role' => 'admin',
        //     'password' => Hash::make('123456'),
        // ]);

        // \App\Models\Poli::factory()->create([
        //     'nama_poli' => 'Poli Gigi',
        // ]);
    }
}
