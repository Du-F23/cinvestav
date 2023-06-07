<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Roles::create([
            'name' => 'admin',
        ]);

        Roles::create([
            'name' => 'viewer',
        ]);

        Roles::create([
            'name' => 'user',
        ]);

        User::create([
            'title' => 'Mr',
            'name' => 'Admin',
            'email' => 'admin@cinvestav.com',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ]);

        User::create([
            'title' => 'Mr',
            'name' => 'Viewer',
            'email' => 'viewer@cinvestav.com',
            'password' => Hash::make('viewer'),
            'role_id' => 2,
        ]);

        User::create([
            'title' => 'Mr',
            'name' => 'User',
            'email' => 'user@cinvestav.com',
            'password' => Hash::make('user'),
            'role_id' => 3,
        ]);

    }
}
