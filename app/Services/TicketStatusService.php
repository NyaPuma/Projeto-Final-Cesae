<?php

namespace App\Services;

use App\Enums\TicketStatusEnum;
use App\Models\TicketStatus;
use Illuminate\Support\Facades\Cache;

final class TicketStatusService
{
    private static array $statusIdCache = [];

    public function getByName(TicketStatusEnum $status): ?int
    {
        $name = $status->value;

        if (array_key_exists($name, self::$statusIdCache)) {
            return self::$statusIdCache[$name];
        }

        $cached = Cache::get("ticket_status:{$name}");

        if ($cached !== null) {
            self::$statusIdCache[$name] = $cached;

            return $cached;
        }

        $id = TicketStatus::where('name', $name)->value('id');

        if ($id === null) {
            $statusModel = TicketStatus::firstOrCreate(['name' => $name]);
            $id = $statusModel->id;
        }

        self::$statusIdCache[$name] = $id;
        Cache::put("ticket_status:{$name}", $id, 3600);

        return $id;
    }

    public function flush(): void
    {
        self::$statusIdCache = [];

        foreach (TicketStatusEnum::cases() as $status) {
            Cache::forget("ticket_status:{$status->value}");
        }

        $allStatuses = TicketStatus::pluck('name')->toArray();
        foreach ($allStatuses as $name) {
            Cache::forget("ticket_status:{$name}");
        }
    }
}
