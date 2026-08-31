<?php

namespace Tests\Feature\Console;

use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;
use Tests\Concerns\CreatesTickets;

class ConsoleCommandsTest extends DatabaseTestCase
{
    use CreatesTickets;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ensureTicketLookupData();
        app(TicketStatusService::class)->flush();
    }

    #[Test]
    public function db_backup_fails_gracefully_for_unknown_connection(): void
    {
        $exitCode = Artisan::call('db:backup', ['--connection' => 'nonexistent']);

        $this->assertEquals(1, $exitCode);
        $this->assertStringContainsString('was not found', Artisan::output());
    }

    #[Test]
    public function fix_ticket_encoding_requires_mysql_driver(): void
    {
        $exitCode = Artisan::call('tickets:fix-encoding');

        $this->assertEquals(1, $exitCode);
        $this->assertStringContainsString('MySQL', Artisan::output());
    }

    #[Test]
    public function audit_partition_requires_mysql_driver(): void
    {
        $exitCode = Artisan::call('audit:partition');

        $this->assertEquals(1, $exitCode);
        $this->assertStringContainsString('MySQL/MariaDB', Artisan::output());
    }

    #[Test]
    public function telemetry_simulation_fails_without_admin_user(): void
    {
        Equipment::factory()->create(['active' => true]);

        $exitCode = Artisan::call('telemetry:simulate');

        $this->assertEquals(1, $exitCode);
        $this->assertStringContainsString('administrator', mb_strtolower(Artisan::output()));
    }

    #[Test]
    public function telemetry_simulation_creates_tickets_when_anomaly_is_detected(): void
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        User::factory()->create(['profile_id' => $profile->id, 'active' => true]);
        Equipment::factory()->create(['active' => true]);

        $exitCode = Artisan::call('telemetry:simulate', [
            '--equipments' => 1,
            '--probability' => 100,
        ]);

        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString('Simulation completed', Artisan::output());
        $this->assertEquals(1, Ticket::where('title', 'like', '[TELEMETRIA]%')->count());
    }

    #[Test]
    public function telemetry_simulation_skips_equipment_with_open_ticket(): void
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        $admin = User::factory()->create(['profile_id' => $profile->id, 'active' => true]);

        $equipment = Equipment::factory()->create(['active' => true]);
        $this->createTicket(['equipment_id' => $equipment->id]);

        $exitCode = Artisan::call('telemetry:simulate', [
            '--equipments' => 1,
            '--probability' => 100,
        ]);

        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString('already has an active ticket', Artisan::output());
        $this->assertEquals(0, Ticket::where('title', 'like', '[TELEMETRIA]%')->count());
    }

    #[Test]
    public function telemetry_simulation_supports_dry_run_without_persisting(): void
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        User::factory()->create(['profile_id' => $profile->id, 'active' => true]);
        Equipment::factory()->create(['active' => true]);

        $exitCode = Artisan::call('telemetry:simulate', [
            '--equipments' => 1,
            '--probability' => 100,
            '--dry-run' => true,
        ]);

        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString('[DRY-RUN]', Artisan::output());
        $this->assertEquals(0, Ticket::count());
    }
}
