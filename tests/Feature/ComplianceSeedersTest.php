<?php

namespace Tests\Feature;

use Database\Seeders\BulkOperationalDataSeeder;
use Database\Seeders\TicketLookupSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ComplianceSeedersTest extends TestCase
{
    use RefreshDatabase;

    public function test_bulk_seeders_generate_100_records_per_core_category_and_use_privacy_safe_data(): void
    {
        $this->seed([
            TicketLookupSeeder::class,
            BulkOperationalDataSeeder::class,
        ]);

        $this->seed([
            TicketLookupSeeder::class,
            BulkOperationalDataSeeder::class,
        ]);

        $this->assertGreaterThanOrEqual(100, DB::table('users')->count());
        $this->assertGreaterThanOrEqual(100, DB::table('rooms')->count());
        $this->assertGreaterThanOrEqual(100, DB::table('equipment_categories')->count());
        $this->assertGreaterThanOrEqual(100, DB::table('equipments')->count());
        $this->assertGreaterThanOrEqual(100, DB::table('tickets')->count());

        $syntheticUsers = DB::table('users')
            ->where('id', '>', 3)
            ->whereNotNull('email')
            ->pluck('email');

        $this->assertNotEmpty($syntheticUsers);

        foreach ($syntheticUsers as $email) {
            $this->assertStringEndsWith('@example.invalid', $email);
        }
    }
}
