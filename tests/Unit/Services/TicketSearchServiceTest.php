<?php

namespace Tests\Unit\Services;

use App\DTOs\TicketFilters;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Services\TicketSearchService;
use App\Services\TicketStatusService;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class TicketSearchServiceTest extends FeatureTestCase
{
    use CreatesTickets;

    private TicketSearchService $service;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->service = app(TicketSearchService::class);
    }

    #[Test]
    public function it_returns_all_tickets_when_no_filters_are_applied(): void
    {
        $this->createTickets(3);

        $result = $this->service->search(new TicketFilters);

        $this->assertEquals(3, $result->total());
        $this->assertEquals(
            config('services.custom.pagination.default_per_page'),
            $result->perPage()
        );
    }

    #[Test]
    public function it_searches_by_title(): void
    {
        $this->createTicket(['title' => 'Avarias no compressor']);
        $this->createTicket(['title' => 'Limpeza da sala']);

        $result = $this->service->search(new TicketFilters(query: 'compressor'));

        $this->assertEquals(1, $result->total());
        $this->assertEquals('Avarias no compressor', $result->getCollection()->first()->title);
    }

    #[Test]
    public function it_searches_by_description(): void
    {
        $this->createTicket(['description' => 'O motor apresentou ruído anormal']);
        $this->createTicket(['description' => 'Troca de lâmpadas']);

        $result = $this->service->search(new TicketFilters(query: 'ruído anormal'));

        $this->assertEquals(1, $result->total());
    }

    #[Test]
    public function it_filters_by_priority(): void
    {
        $this->createTicket(['priority' => TicketPriorityEnum::High->value]);
        $this->createTicket(['priority' => TicketPriorityEnum::Low->value]);

        $result = $this->service->search(new TicketFilters(priority: TicketPriorityEnum::High));

        $this->assertEquals(1, $result->total());
        $this->assertEquals(TicketPriorityEnum::High->value, $result->getCollection()->first()->priority);
    }

    #[Test]
    public function it_filters_by_status(): void
    {
        $closedStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Closed);
        $this->createTicket(['title' => 'Ticket fechado', 'status_id' => $closedStatusId]);
        $this->createTicket(['title' => 'Ticket aberto']);

        $result = $this->service->search(new TicketFilters(status: 'fechada'));

        $this->assertEquals(1, $result->total());
        $this->assertEquals('Ticket fechado', $result->getCollection()->first()->title);
    }

    #[Test]
    public function it_filters_by_date_range(): void
    {
        $recent = $this->createTicket();
        $recent->created_at = now()->subDays(5);
        $recent->save();

        $older = $this->createTicket();
        $older->created_at = now()->subDays(20);
        $older->save();

        $result = $this->service->search(new TicketFilters(
            dateFrom: CarbonImmutable::now()->subDays(10),
            dateTo: CarbonImmutable::now(),
        ));

        $this->assertEquals(1, $result->total());
        $this->assertEquals($recent->id, $result->getCollection()->first()->id);
    }

    #[Test]
    public function it_filters_by_start_date_only(): void
    {
        $recent = $this->createTicket();
        $recent->created_at = now()->subDays(5);
        $recent->save();

        $older = $this->createTicket();
        $older->created_at = now()->subDays(15);
        $older->save();

        $result = $this->service->search(new TicketFilters(
            dateFrom: CarbonImmutable::now()->subDays(10),
        ));

        $this->assertEquals(1, $result->total());
        $this->assertEquals($recent->id, $result->getCollection()->first()->id);
    }

    #[Test]
    public function it_filters_by_end_date_only(): void
    {
        $recent = $this->createTicket();
        $recent->created_at = now()->subDays(5);
        $recent->save();

        $older = $this->createTicket();
        $older->created_at = now()->subDays(15);
        $older->save();

        $result = $this->service->search(new TicketFilters(
            dateTo: CarbonImmutable::now()->subDays(10),
        ));

        $this->assertEquals(1, $result->total());
        $this->assertEquals($older->id, $result->getCollection()->first()->id);
    }

    #[Test]
    public function it_rejects_an_invalid_date_range_where_start_is_after_end(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('dateFrom cannot be later than dateTo.');

        $this->service->search(new TicketFilters(
            dateFrom: CarbonImmutable::now(),
            dateTo: CarbonImmutable::now()->subDays(5),
        ));
    }

    #[Test]
    public function it_loads_expected_relations_on_results(): void
    {
        $this->createTicketWithEquipment();

        $result = $this->service->search(new TicketFilters);

        $ticket = $result->getCollection()->first();
        $this->assertTrue($ticket->relationLoaded('equipment'));
        $this->assertTrue($ticket->relationLoaded('room'));
        $this->assertTrue($ticket->relationLoaded('user'));
        $this->assertTrue($ticket->relationLoaded('status'));
        $this->assertTrue($ticket->relationLoaded('technician'));
    }

    #[Test]
    public function it_returns_an_empty_paginator_when_nothing_matches(): void
    {
        $this->createTicket(['title' => 'Existe']);

        $result = $this->service->search(new TicketFilters(query: 'não-existe-nada'));

        $this->assertEquals(0, $result->total());
        $this->assertEmpty($result->items());
    }
}
