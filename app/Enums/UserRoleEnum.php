<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case User = 'user';
    case Technician = 'technician';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::User => 'Utilizador',
            self::Technician => 'Técnico',
            self::Admin => 'Administrador',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
