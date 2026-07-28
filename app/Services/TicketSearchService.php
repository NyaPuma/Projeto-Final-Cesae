<?php

namespace App\Services;

use App\DTOs\TicketFilters;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class TicketSearchService
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function search(TicketFilters $filters): LengthAwarePaginator
    {
        $query = Ticket::with(['equipment', 'room', 'user', 'status', 'technician']);

        if ($filters->query !== null) {
            $q = str_replace(['%', '_'], ['\%', '\_'], $filters->query);
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($filters->priority !== null) {
            $query->where('priority', $filters->priority->value);
        }

        if ($filters->status !== null) {
            $statusEnum = TicketStatusEnum::fromValue($filters->status);
            if ($statusEnum) {
                $statusId = $this->statusService->getByName($statusEnum);
                $query->where('status_id', $statusId);
            }
        }

        if ($filters->dateFrom !== null && $filters->dateTo !== null && $filters->dateFrom > $filters->dateTo) {
            abort(422, 'A data de início não pode ser posterior à data de fim.');
        }

        $this->applyDateFilters($query, $filters->dateFrom, $filters->dateTo);

        return $query->latest()->paginate(config('services.custom.pagination.default_per_page'));
    }

    private function applyDateFilters($query, ?string $dateFrom, ?string $dateTo): void
    {
        if ($dateFrom !== null && $dateTo !== null) {
            $query->whereBetween('created_at', [$dateFrom, $dateTo.' 23:59:59']);
        } elseif ($dateFrom !== null) {
            $query->whereDate('created_at', '>=', $dateFrom);
        } elseif ($dateTo !== null) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
    }
}
