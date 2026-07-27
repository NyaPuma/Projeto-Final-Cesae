<?php

namespace Tests\Fixtures\Datasets;

class TicketStatusDataset
{
    public static function statuses(): array
    {
        return [
            'open' => ['aberta'],
            'in progress' => ['em curso'],
            'closed' => ['fechada'],
            'cancelled' => ['cancelada'],
            'pending budget' => ['pendente orçamento'],
            'rejected' => ['recusada'],
        ];
    }

    public static function validTransitions(): array
    {
        return [
            'open to in progress' => ['aberta', 'em curso'],
            'in progress to closed' => ['em curso', 'fechada'],
            'open to cancelled' => ['aberta', 'cancelada'],
            'in progress to cancelled' => ['em curso', 'cancelada'],
        ];
    }

    public static function invalidTransitions(): array
    {
        return [
            'closed to open' => ['fechada', 'aberta'],
            'cancelled to in progress' => ['cancelada', 'em curso'],
            'rejected to closed' => ['recusada', 'fechada'],
        ];
    }
}
