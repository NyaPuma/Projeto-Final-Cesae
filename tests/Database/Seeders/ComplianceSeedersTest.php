<?php

namespace Tests\Database\Seeders;

use App\Enums\TicketStatusEnum;
use Database\Seeders\BulkOperationalDataSeeder;
use Database\Seeders\TicketLookupSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ComplianceSeedersTest extends TestCase
{
    use RefreshDatabase;

    public function test_bulk_seeders_generate_realistic_records_per_core_category_and_use_privacy_safe_data(): void
    {
        $this->seed([
            TicketLookupSeeder::class,
            BulkOperationalDataSeeder::class,
        ]);

        $this->assertGreaterThanOrEqual(30, DB::table('users')->count());
        $this->assertGreaterThanOrEqual(45, DB::table('rooms')->count());
        $this->assertGreaterThanOrEqual(30, DB::table('equipment_categories')->count());
        $this->assertGreaterThanOrEqual(40, DB::table('equipments')->count());
        $this->assertGreaterThanOrEqual(60, DB::table('tickets')->count());

        $syntheticUsers = DB::table('users')
            ->where('id', '>', 3)
            ->whereNotNull('email')
            ->pluck('email');

        $this->assertNotEmpty($syntheticUsers);

        foreach ($syntheticUsers as $email) {
            $this->assertStringEndsWith('@example.invalid', $email);
        }
    }

    public function test_seeded_tickets_cover_all_ticket_status_enum_values(): void
    {
        $this->seed([
            TicketLookupSeeder::class,
            BulkOperationalDataSeeder::class,
        ]);

        $present = DB::table('tickets')
            ->join('ticket_statuses', 'tickets.status_id', '=', 'ticket_statuses.id')
            ->distinct()
            ->pluck('ticket_statuses.name');

        foreach (TicketStatusEnum::cases() as $status) {
            $this->assertTrue(
                $present->contains($status->value),
                "O estado {$status->value} deve estar representado nos tickets semeados.",
            );
        }
    }
}
