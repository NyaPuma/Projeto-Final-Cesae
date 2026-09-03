<?php

namespace Tests\Fixtures\Datasets;

use App\Enums\TicketStatusEnum;

class TicketStatusDataset
{
    public static function statuses(): array
    {
        return [
            'open' => [TicketStatusEnum::Open->value],
            'in progress' => [TicketStatusEnum::InProgress->value],
            'closed' => [TicketStatusEnum::Closed->value],
            'cancelled' => [TicketStatusEnum::Cancelled->value],
            'pending budget' => [TicketStatusEnum::PendingBudget->value],
            'rejected' => [TicketStatusEnum::Rejected->value],
        ];
    }

    public static function validTransitions(): array
    {
        return [
            'open to in progress' => [TicketStatusEnum::Open->value, TicketStatusEnum::InProgress->value],
            'in progress to closed' => [TicketStatusEnum::InProgress->value, TicketStatusEnum::Closed->value],
            'open to cancelled' => [TicketStatusEnum::Open->value, TicketStatusEnum::Cancelled->value],
            'in progress to cancelled' => [TicketStatusEnum::InProgress->value, TicketStatusEnum::Cancelled->value],
        ];
    }

    public static function invalidTransitions(): array
    {
        return [
            'closed to open' => [TicketStatusEnum::Closed->value, TicketStatusEnum::Open->value],
            'cancelled to in progress' => [TicketStatusEnum::Cancelled->value, TicketStatusEnum::InProgress->value],
            'rejected to closed' => [TicketStatusEnum::Rejected->value, TicketStatusEnum::Closed->value],
        ];
    }
}
