<?php

namespace Tests\Unit\Services;

use App\Models\Equipment;
use App\Models\Ticket;
use App\Services\CalendarService;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class CalendarServiceTest extends FeatureTestCase
{
    private CalendarService $service;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->service = new CalendarService;
    }

    #[Test]
    public function it_returns_only_scheduled_tickets_as_events(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();

        $scheduled = Ticket::factory()->create([
            'user_id' => $admin->id,
            'assigned_to' => $technician->id,
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
            'scheduled_end' => now()->addDay()->addHours(2),
        ]);

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'scheduled' => false,
            'scheduled_at' => null,
            'opened_at' => null,
            'resolved_at' => null,
        ]);

        $events = $this->service->getScheduledEventsForUser($admin);

        $this->assertCount(1, $events);
        $this->assertEquals($scheduled->id, $events->first()['id']);
        $this->assertArrayHasKey('start', $events->first());
        $this->assertArrayHasKey('end', $events->first());
        $this->assertStringContainsString("/ui/tickets/{$scheduled->id}", $events->first()['extendedProps']['url']);
    }

    #[Test]
    public function it_uses_equipment_name_as_event_title(): void
    {
        $admin = $this->createAdmin();
        $equipment = Equipment::factory()->create(['name' => 'Bomba Hidráulica']);

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'equipment_id' => $equipment->id,
            'title' => '',
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
        ]);

        $events = $this->service->getScheduledEventsForUser($admin);

        $this->assertEquals('Bomba Hidráulica', $events->first()['title']);
    }

    #[Test]
    public function it_uses_generic_title_when_ticket_has_no_equipment(): void
    {
        $admin = $this->createAdmin();

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'equipment_id' => null,
            'title' => '',
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
        ]);

        $events = $this->service->getScheduledEventsForUser($admin);

        $this->assertEquals('General Fault', $events->first()['title']);
    }

    #[Test]
    public function it_restricts_events_to_technician_own_assigned_tickets(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $otherTechnician = $this->createTechnician();

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'assigned_to' => $technician->id,
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
        ]);

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'assigned_to' => $otherTechnician->id,
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
        ]);

        $events = $this->service->getScheduledEventsForUser($technician);

        $this->assertCount(1, $events);
        $this->assertEquals($technician->id, Ticket::find($events->first()['id'])->assigned_to);
    }

    #[Test]
    public function it_returns_all_scheduled_events_for_administrators(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $otherTechnician = $this->createTechnician();

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'assigned_to' => $technician->id,
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
        ]);

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'assigned_to' => $otherTechnician->id,
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
        ]);

        $events = $this->service->getScheduledEventsForUser($admin);

        $this->assertCount(2, $events);
    }

    #[Test]
    public function it_delegates_global_events_to_the_scheduled_events_query(): void
    {
        $admin = $this->createAdmin();

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'scheduled' => true,
            'scheduled_at' => now()->addDay(),
        ]);

        Ticket::factory()->create([
            'user_id' => $admin->id,
            'scheduled' => true,
            'scheduled_at' => now()->addDays(5),
            'opened_at' => now()->addDays(10),
        ]);

        $from = now()->toDateString();
        $to = now()->addDays(2)->toDateString();

        $events = $this->service->getScheduledEvents($from, $to);

        $this->assertCount(1, $events);
        $this->assertArrayHasKey('title', $events->first());
        $this->assertArrayHasKey('start', $events->first());
    }
}
