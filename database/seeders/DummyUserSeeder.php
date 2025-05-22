<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 10000; $i++) {
            User::factory()->create([
                'image' => 'gps.jpg',
                'name' => "Test User $i",
                'email' => "adellana$i@example.com",
                'role' => 'user',
                'password' => Hash::make('123456'),
            ]);
        }
    }
}
