<?php

namespace App\Enums;

enum NotificationPriorityEnum: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
    case Urgent = 'urgent';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
