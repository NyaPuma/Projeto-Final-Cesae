<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TicketLookupSeeder::class,
            UserProfilesSeeder::class,
            UsersSeeder::class,
            BulkOperationalDataSeeder::class,
        ]);
    }
}