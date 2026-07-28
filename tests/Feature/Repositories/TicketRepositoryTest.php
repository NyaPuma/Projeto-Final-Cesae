<?php

namespace Tests\Feature\Repositories;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class TicketRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private TicketRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TicketRepository;
    }

    public function test_it_finds_ticket_by_id(): void
    {
        $ticket = Ticket::factory()->create();

        $found = $this->repository->findById($ticket->id);

        $this->assertNotNull($found);
        $this->assertEquals($ticket->id, $found->id);
    }

    public function test_it_returns_null_for_nonexistent_ticket(): void
    {
        $found = $this->repository->findById(99999);

        $this->assertNull($found);
    }

    public function test_it_gets_all_tickets_with_relations(): void
    {
        Ticket::factory()->count(3)->create();

        $tickets = $this->repository->getAll();

        $this->assertCount(3, $tickets->items());
    }
}
