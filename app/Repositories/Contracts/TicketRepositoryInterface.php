<?php

namespace App\Repositories\Contracts;

use App\DTOs\TicketFilters;
use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    public function findById(int $id): ?Ticket;

    public function findWithRelations(int $id, array $relations = []): ?Ticket;

    public function getAll(array $relations = []): LengthAwarePaginator;

    public function search(TicketFilters $filters): LengthAwarePaginator;

    public function create(array $data): Ticket;

    public function update(Ticket $ticket, array $data): bool;

    public function delete(Ticket $ticket): bool;

    public function getOpenTickets(): LengthAwarePaginator;

    public function getTicketsByTechnician(int $technicianId): LengthAwarePaginator;

    public function getTicketsByUser(int $userId): LengthAwarePaginator;
}
