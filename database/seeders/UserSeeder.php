<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Cyntia Citra',
            'email' => 'cyntra@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'user 1',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}
