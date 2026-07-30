<?php

namespace App\Enums;

enum AuditEventEnum: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Deleted = 'deleted';
    case Login = 'login';
    case Logout = 'logout';
    case PasswordChanged = 'password_changed';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
