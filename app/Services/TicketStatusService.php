<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\TicketStatusEnum;
use App\Models\TicketStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final class TicketStatusService
{
    /**
     * Static in-memory cache to optimize repeated queries during request lifecycle.
     *
     * @var array<string, int>
     */
    private static array $statusIdCache = [];

    /**
     * Gets ticket status ID by enum name, using in-memory and persistent cache.
     *
     * @param TicketStatusEnum $status
     * @return int|null
     */
    public function getByName(TicketStatusEnum $status): ?int
    {
        $name = $status->value;

        if (array_key_exists($name, self::$statusIdCache)) {
            return self::$statusIdCache[$name];
        }

        /** @var int|null $cached */
        $cached = Cache::get("ticket_status:{$name}");

        if ($cached !== null) {
            self::$statusIdCache[$name] = $cached;

            return $cached;
        }

        /** @var int|null $id */
        $id = TicketStatus::where('name', $name)->value('id');

        if ($id === null) {
            $code = match ($status) {
                TicketStatusEnum::Open => 'ABERTA',
                TicketStatusEnum::InProgress => 'EM_CURSO',
                TicketStatusEnum::Closed => 'FECHADA',
                TicketStatusEnum::Cancelled => 'CANCELADA',
                TicketStatusEnum::PendingBudget => 'PENDENTE_ORCAMENTO',
                TicketStatusEnum::Rejected => 'RECUSADA',
            };
            $statusModel = TicketStatus::firstOrCreate(['name' => $name], ['code' => $code]);
            $id = $statusModel->id;
        }

        self::$statusIdCache[$name] = $id;
        Cache::put("ticket_status:{$name}", $id, 3600);

        return $id;
    }

    /**
     * Clears all static in-memory cache and persistent cache related to ticket statuses.
     */
    public function flush(): void
    {
        self::$statusIdCache = [];

        foreach (TicketStatusEnum::cases() as $status) {
            Cache::forget("ticket_status:{$status->value}");
        }

        /** @var array<int, string> $allStatuses */
        $allStatuses = TicketStatus::pluck('name')->toArray();

        foreach ($allStatuses as $name) {
            Cache::forget("ticket_status:{$name}");
        }
    }
}
