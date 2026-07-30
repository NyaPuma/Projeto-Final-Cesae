<?php

namespace App\Domain\Ticket\Scopes;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Services\TicketStatusService;
use Illuminate\Database\Eloquent\Builder;

final class TicketScopes
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function scopeOpen(Builder $query): Builder
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::Open);

        return $query->where('status_id', $statusId);
    }

    public function scopeInProgress(Builder $query): Builder
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::InProgress);

        return $query->where('status_id', $statusId);
    }

    public function scopeClosed(Builder $query): Builder
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::Closed);

        return $query->where('status_id', $statusId);
    }

    public function scopeScheduled(Builder $query): Builder
    {
        return $query->whereNotNull('scheduled_at');
    }

    public function scopeByPriority(Builder $query, TicketPriorityEnum $priority): Builder
    {
        return $query->where('priority', $priority->value);
    }

    public function scopeForTechnician(Builder $query, int $technicianId): Builder
    {
        return $query->where('assigned_to', $technicianId);
    }
}
