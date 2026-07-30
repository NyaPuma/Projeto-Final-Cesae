<?php

namespace Tests\Fixtures\Datasets;

class TicketPriorityDataset
{
    public static function priorities(): array
    {
        return [
            'low priority' => ['baixa'],
            'medium priority' => ['média'],
            'high priority' => ['alta'],
        ];
    }

    public static function prioritiesWithNormalization(): array
    {
        return [
            'low (normalized)' => ['baixa'],
            'medium (normalized)' => ['média'],
            'high (normalized)' => ['alta'],
            'low (alternative)' => ['media'], // Will be normalized to média
        ];
    }

    public static function invalidPriorities(): array
    {
        return [
            'urgent' => ['urgent'],
            'critical' => ['critical'],
            'empty' => [''],
            'null' => [null],
        ];
    }
}
