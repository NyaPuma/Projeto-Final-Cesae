<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfilesSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [
            ['name' => 'admin'],
            ['name' => 'technician'],
            ['name' => 'user'],
        ];

        foreach ($profiles as $profile) {
            DB::table('user_profiles')->updateOrInsert(
                ['name' => $profile['name']],
                ['name' => $profile['name'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
