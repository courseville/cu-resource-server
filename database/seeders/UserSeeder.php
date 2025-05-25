<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => '2',
            'email' => '2@example.com',
            'password' => '12345678',
        ]);
        User::factory()->create([
            'name' => '3',
            'email' => '3@example.com',
            'password' => '12345678',
        ]);
        User::factory()->create([
            'name' => '4',
            'email' => '4@example.com',
            'password' => '12345678',
        ]);
    }
}
