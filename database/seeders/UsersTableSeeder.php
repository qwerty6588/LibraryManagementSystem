<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'admin',
            ],
            [
                'name' => 'user',
            ]
        ]);
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            'name' => 'Abbos',
            'email' => 'abbos@admin.com',
            'role_id' => 1,
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role_id' => 2,
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach (range(1, 10) as $index) {
            User::create([
                'name' => 'User ' . $index,
                'email' => 'user_loop_' . $index . '@example.com',
                'role_id' => 2,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
