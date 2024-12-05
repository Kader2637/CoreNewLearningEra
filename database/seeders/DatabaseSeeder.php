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
            'name' => 'Abdul Kader',
            'email' => 'abdulkader0126@gmail.com',
            'password' => '12345678',
            'role' => 'student',
            'no_telephone' => '0098765432456',
            'status' => 'accept'
        ]);
    }
}
