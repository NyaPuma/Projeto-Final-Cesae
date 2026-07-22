<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $profileIds = DB::table('user_profiles')->pluck('id', 'name');

        $defaultUsers = [
            [
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'profile_name' => 'admin',
                'password' => bcrypt('admin123'),
                'api_token' => 'admin-token-'.Str::random(40),
            ],
            [
                'name' => 'Técnico',
                'email' => 'tech@example.com',
                'profile_name' => 'technician',
                'password' => bcrypt('tech123'),
                'api_token' => 'tech-token-'.Str::random(40),
            ],
            [
                'name' => 'Utilizador',
                'email' => 'user@example.com',
                'profile_name' => 'user',
                'password' => bcrypt('user123'),
                'api_token' => 'user-token-'.Str::random(40),
            ],
        ];

        foreach ($defaultUsers as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'email_verified_at' => now(),
                    'password' => $user['password'],
                    'profile_id' => $profileIds[$user['profile_name']] ?? $profileIds['user'],
                    'active' => true,
                    'api_token' => $user['api_token'],
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $targetCount = 100;
        $currentCount = DB::table('users')->count();

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            $profileName = $index % 3 === 0 ? 'technician' : ($index % 2 === 0 ? 'user' : 'admin');
            $email = sprintf('synthetic-%03d@example.invalid', $index);

            DB::table('users')->updateOrInsert(
                ['email' => $email],
                [
                    'name' => 'Utilizador Sintético '.str_pad((string) $index, 3, '0', STR_PAD_LEFT),
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => bcrypt('Password123!'),
                    'profile_id' => $profileIds[$profileName] ?? $profileIds['user'],
                    'active' => true,
                    'api_token' => 'synthetic-'.Str::random(40),
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
