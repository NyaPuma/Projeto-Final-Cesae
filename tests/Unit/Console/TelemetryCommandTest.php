<?php

namespace Tests\Unit\Console;

use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Tests\Base\FeatureTestCase;

class TelemetryCommandTest extends FeatureTestCase
{
    private function makeEquipment(bool $active = true): Equipment
    {
        return Equipment::factory()->create([
            'category_id' => EquipmentCategory::factory(),
            'room_id' => Room::factory(),
            'active' => $active,
        ]);
    }

    private function admin(): User
    {
        return User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id,
        ]);
    }

    public function test_command_fails_without_admin_user(): void
    {
        $this->makeEquipment();

        $exit = $this->artisan('telemetry:simulate', ['--equipments' => 5, '--probability' => 100])
            ->expectsOutputToContain('No administrator user found')
            ->run();

        $this->assertNotSame(0, $exit);
        $this->assertSame(0, Ticket::count());
    }

    public function test_command_creates_telemetry_tickets_with_full_probability(): void
    {
        $this->admin();
        $equipment = $this->makeEquipment();

        $exit = $this->artisan('telemetry:simulate', ['--equipments' => 5, '--probability' => 100])->run();

        $this->assertSame(0, $exit);
        $this->assertSame(1, Ticket::count());

        $ticket = Ticket::first();
        $this->assertStringStartsWith('[TELEMETRIA]', $ticket->title);
        $this->assertSame($equipment->id, $ticket->equipment_id);
        $this->assertSame(
            app(TicketStatusService::class)->getByName(TicketStatusEnum::Open),
            $ticket->status_id
        );
    }

    public function test_command_skips_equipments_with_existing_open_ticket(): void
    {
        $this->admin();
        $equipment = $this->makeEquipment();
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);
        Ticket::factory()->create(['status_id' => $openId, 'equipment_id' => $equipment->id]);

        $exit = $this->artisan('telemetry:simulate', ['--equipments' => 5, '--probability' => 100])->run();

        $this->assertSame(0, $exit);
        $this->assertSame(1, Ticket::count());
    }

    public function test_command_dry_run_does_not_persist_tickets(): void
    {
        $this->admin();
        $this->makeEquipment();

        $exit = $this->artisan('telemetry:simulate', ['--equipments' => 5, '--probability' => 100, '--dry-run' => true])->run();

        $this->assertSame(0, $exit);
        $this->assertSame(0, Ticket::count());
    }
}
