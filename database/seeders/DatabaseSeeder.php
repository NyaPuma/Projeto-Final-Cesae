<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'     => 'Administrador',
            'email'    => 'admin@example.com',
            'role'     => User::ROLE_ADMIN,
            'password' => 'admin123',
        ]);

        User::factory()->create([
            'name'     => 'Técnico',
            'email'    => 'tech@example.com',
            'role'     => User::ROLE_TECHNICIAN,
            'password' => 'tech123',
        ]);

        User::factory()->create([
            'name'     => 'Utilizador',
            'email'    => 'user@example.com',
            'role'     => User::ROLE_USER,
            'password' => 'user123',
        ]);
    }
}
