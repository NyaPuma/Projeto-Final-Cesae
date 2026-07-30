<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\TicketStatusEnum;
use App\Models\TicketStatus;
use Illuminate\Support\Facades\Cache;

final class TicketStatusService
{
    /**
     * Cache estático em memória para otimizar consultas repetidas durante o ciclo de vida do pedido.
     *
     * @var array<string, int>
     */
    private static array $statusIdCache = [];

    /**
     * Obtém o ID do estado do ticket pelo nome do enum, utilizando cache em memória e persistente.
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
            $statusModel = TicketStatus::firstOrCreate(['name' => $name]);
            $id = $statusModel->id;
        }

        self::$statusIdCache[$name] = $id;
        Cache::put("ticket_status:{$name}", $id, 3600);

        return $id;
    }

    /**
     * Limpa todo o cache estático em memória e o cache persistente relacionado aos estados dos tickets.
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
