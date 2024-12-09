<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'image' => 'user.png',
            'name' => 'Abdul Kader',
            'email' => 'abdulkader0126@gmail.com',
            'password' => '12345678',
            'role' => 'student',
            'no_telephone' => '0098765432456',
            'status' => 'accept'
        ]);
        User::factory()->create([
            'image' => 'user.png',
            'name' => 'Ivan maulana tjiptady',
            'email' => 'ivan@gmail.com',
            'password' => '12345678',
            'role' => 'teacher',
            'no_telephone' => '0098765432456',
            'status' => 'pending'
        ]);
        User::factory()->create([
            'image' => 'user.png',
            'name' => 'Erik Aditya Irvansya',
            'email' => 'erik@gmail.com',
            'password' => '12345678',
            'role' => 'teacher',
            'no_telephone' => '0098765432456',
            'status' => 'accept'
        ]);
        User::factory()->create([
            'image' => 'user.png',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => 'admin',
            'no_telephone' => '0098765432456',
            'status' => 'accept'
        ]);
    }
}
