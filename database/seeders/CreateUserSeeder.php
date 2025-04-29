<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user' => 'admin',
                'password'=> bcrypt('admin'),
                'admin_type' => 'admin',
            ],
            [
                'user'=> 'guest',
                'password'=> bcrypt('guest'),
                'admin_type' => 'guest',
            ]
        ];

        foreach ($users as $key => $user) {
            \App\Models\User::create($user);
        }
    }
}
