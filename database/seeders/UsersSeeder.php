<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Data\OperationalData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->error('ABORTADO: Este seeder não deve ser executado em produção!');

            return;
        }

        $profileIds = DB::table('user_profiles')->pluck('id', 'name');

        $defaultUsers = [
            [
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'profile_name' => 'admin',
                'password' => Hash::make('Password123!'),
                'api_token' => User::hashToken(Str::random(60)),
            ],
            [
                'name' => 'Técnico',
                'email' => 'tech@example.com',
                'profile_name' => 'technician',
                'password' => Hash::make('Password123!'),
                'api_token' => User::hashToken(Str::random(60)),
            ],
            [
                'name' => 'Utilizador',
                'email' => 'user@example.com',
                'profile_name' => 'user',
                'password' => Hash::make('Password123!'),
                'api_token' => User::hashToken(Str::random(60)),
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

        $names = OperationalData::technicianNames();
        $nameIndex = 0;

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            // Realistic distribution: ~10% admin, ~15% technician, ~75% regular user
            $roll = $index % 10;
            $profileName = $roll === 0 ? 'admin' : ($roll <= 2 ? 'technician' : 'user');
            $email = sprintf('synthetic-%03d@example.invalid', $index);

            $name = $profileName === 'technician'
                ? $names['first'][$nameIndex % count($names['first'])].' '.$names['last'][$nameIndex % count($names['last'])]
                : 'Utilizador Sintético '.str_pad((string) $index, 3, '0', STR_PAD_LEFT);

            $nameIndex++;

            // Realistic active status: ~85% active, ~15% inactive
            $isActive = (rand(1, 100) <= 85);

            DB::table('users')->updateOrInsert(
                ['email' => $email],
                [
                    'name' => $name,
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'profile_id' => $profileIds[$profileName] ?? $profileIds['user'],
                    'active' => $isActive,
                    'api_token' => User::hashToken(Str::random(60)),
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Ensure realistic distribution by explicitly setting some users as inactive
        // 15% of users should be inactive
        $totalUsers = DB::table('users')->count();
        $inactiveCount = (int) floor($totalUsers * 0.15);

        $defaultUserEmails = collect($defaultUsers)->pluck('email');
        $activeUsers = DB::table('users')
            ->where('active', true)
            ->whereNotIn('email', $defaultUserEmails)
            ->pluck('id')
            ->shuffle()
            ->take($inactiveCount);

        DB::table('users')->whereIn('id', $activeUsers)->update(['active' => false]);
    }
}
