<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\TicketFilters;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

final class TicketSearchService
{
    /**
     * @param TicketStatusService $statusService
     */
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    /**
     * Executa a pesquisa e filtragem de tickets com paginação.
     *
     * @param TicketFilters $filters
     * @return LengthAwarePaginator<Ticket>
     */
    public function search(TicketFilters $filters): LengthAwarePaginator
    {
        $query = Ticket::with(['equipment', 'room', 'user', 'status', 'technician']);

        if ($filters->query !== null && $filters->query !== '') {
            $q = str_replace(['%', '_'], ['\%', '\_'], $filters->query);
            $query->where(function (Builder $sub) use ($q): void {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($filters->priority !== null) {
            $query->where('priority', $filters->priority->value);
        }

        if ($filters->status !== null) {
            $statusEnum = TicketStatusEnum::normalize($filters->status);
            if ($statusEnum) {
                $statusId = $this->statusService->getByName($statusEnum);
                $query->where('status_id', $statusId);
            }
        }

        if ($filters->dateFrom !== null && $filters->dateTo !== null && $filters->dateFrom > $filters->dateTo) {
            throw new \InvalidArgumentException('A data de início não pode ser posterior à data de fim.');
        }

        $this->applyDateFilters($query, $filters->dateFrom, $filters->dateTo);

        /** @var int $perPage */
        $perPage = config('services.custom.pagination.default_per_page', 15);

        return $query->latest()->paginate($perPage);
    }

    /**
     * Aplica os filtros de data à consulta de tickets de forma segura.
     *
     * @param Builder $query
     * @param string|null $dateFrom
     * @param string|null $dateTo
     */
    private function applyDateFilters(Builder $query, ?string $dateFrom, ?string $dateTo): void
    {
        if ($dateFrom !== null && $dateTo !== null) {
            $query->whereBetween('created_at', [$dateFrom, $dateTo . ' 23:59:59']);
        } elseif ($dateFrom !== null) {
            $query->whereDate('created_at', '>=', $dateFrom);
        } elseif ($dateTo !== null) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
    }
}
