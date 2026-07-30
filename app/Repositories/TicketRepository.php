<?php

namespace App\Repositories;

use App\DTOs\TicketFilters;
use App\Models\Ticket;
use App\Repositories\Contracts\TicketRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class TicketRepository implements TicketRepositoryInterface
{
    public function findById(int $id): ?Ticket
    {
        return Ticket::find($id);
    }

    public function findWithRelations(int $id, array $relations = []): ?Ticket
    {
        return Ticket::with($relations)->find($id);
    }

    public function getAll(array $relations = []): LengthAwarePaginator
    {
        return Ticket::with($relations)->latest()->paginate(15);
    }

    public function search(TicketFilters $filters): LengthAwarePaginator
    {
        $query = Ticket::with(['equipment', 'room', 'user', 'technician', 'status']);

        if ($filters->query) {
            $q = str_replace(['%', '_'], ['\%', '\_'], $filters->query);
            $query->where('title', 'like', '%'.$q.'%');
        }

        if ($filters->status) {
            $query->where('status_id', $filters->status);
        }

        if ($filters->priority) {
            $query->where('priority', $filters->priority);
        }

        if ($filters->userId) {
            $query->where('user_id', $filters->userId);
        }

        if ($filters->technicianId) {
            $query->where('assigned_to', $filters->technicianId);
        }

        if ($filters->equipmentId) {
            $query->where('equipment_id', $filters->equipmentId);
        }

        if ($filters->roomId) {
            $query->where('room_id', $filters->roomId);
        }

        return $query->latest()->paginate(15);
    }

    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function update(Ticket $ticket, array $data): bool
    {
        return $ticket->update($data);
    }

    public function delete(Ticket $ticket): bool
    {
        return $ticket->delete();
    }

    public function getOpenTickets(): LengthAwarePaginator
    {
        return Ticket::with(['equipment', 'room', 'user', 'status'])
            ->open()
            ->latest()
            ->paginate(15);
    }

    public function getTicketsByTechnician(int $technicianId): LengthAwarePaginator
    {
        return Ticket::with(['equipment', 'room', 'user', 'status'])
            ->forTechnician($technicianId)
            ->latest()
            ->paginate(15);
    }

    public function getTicketsByUser(int $userId): LengthAwarePaginator
    {
        return Ticket::with(['equipment', 'room', 'technician', 'status'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(15);
    }
}
