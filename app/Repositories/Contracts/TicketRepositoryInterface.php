<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    /**
     * Find a ticket by its ID.
     *
     * @param int $id
     * @return Ticket|null
     */
    public function findById(int $id): ?Ticket;

    /**
     * Find a ticket by its ID, loading specific relationships.
     *
     * @param int $id
     * @param array<int, string> $relations
     * @return Ticket|null
     */
    public function findWithRelations(int $id, array $relations = []): ?Ticket;

    /**
     * Return a paginated list of tickets.
     *
     * @param array<int, string> $relations
     * @return LengthAwarePaginator<Ticket>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Create a new ticket.
     *
     * @param array<string, mixed> $data
     * @return Ticket
     */
    public function create(array $data): Ticket;

    /**
     * Update an existing ticket.
     *
     * @param Ticket $ticket
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(Ticket $ticket, array $data): bool;

    /**
     * Delete a ticket from the database.
     *
     * @param Ticket $ticket
     * @return bool
     */
    public function delete(Ticket $ticket): bool;

    /**
     * Return all open tickets in a paginated manner.
     *
     * @return LengthAwarePaginator<Ticket>
     */
    public function getOpenTickets(): LengthAwarePaginator;

    /**
     * Return tickets assigned to a specific technician.
     *
     * @param int $technicianId
     * @return LengthAwarePaginator<Ticket>
     */
    public function getTicketsByTechnician(int $technicianId): LengthAwarePaginator;

    /**
     * Return tickets created by a specific user.
     *
     * @param int $userId
     * @return LengthAwarePaginator<Ticket>
     */
    public function getTicketsByUser(int $userId): LengthAwarePaginator;
}
