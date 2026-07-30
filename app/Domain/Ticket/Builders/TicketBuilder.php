<?php

namespace App\Domain\Ticket\Builders;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\User;
use App\Services\TicketStatusService;
use Illuminate\Database\Eloquent\Builder;
use RuntimeException;

/**
 * @extends Builder<\App\Models\Ticket>
 */
final class TicketBuilder extends Builder
{
    /**
     * Filtra tickets pelo enum de estado garantindo a resolução segura do ID.
     */
    public function whereStatus(TicketStatusEnum $status): self
    {
        $statusId = app(TicketStatusService::class)->getByName($status);

        if ($statusId === null) {
            throw new RuntimeException("O estado '{$status->value}' não foi encontrado no sistema.");
        }

        return $this->where('status_id', $statusId);
    }

    public function open(): self
    {
        return $this->whereStatus(TicketStatusEnum::Open);
    }

    public function inProgress(): self
    {
        return $this->whereStatus(TicketStatusEnum::InProgress);
    }

    public function closed(): self
    {
        return $this->whereStatus(TicketStatusEnum::Closed);
    }

    public function scheduled(): self
    {
        return $this->whereNotNull('scheduled_at');
    }

    public function byPriority(TicketPriorityEnum|string $priority): self
    {
        $priorityValue = $priority instanceof TicketPriorityEnum ? $priority->value : $priority;

        return $this->where('priority', $priorityValue);
    }

    public function forTechnician(User|int|null $technician): self
    {
        if ($technician === null) {
            return $this->whereNull('assigned_to');
        }

        $technicianId = $technician instanceof User ? $technician->id : $technician;

        return $this->where('assigned_to', $technicianId);
    }
}
