<?php

namespace App\Enums;

enum TicketPriorityEnum: string
{
    case Low = 'baixa';
    case Medium = 'média';
    case High = 'alta';
    case Critical = 'crítica';

    public function label(): string
    {
        return match ($this) {
            self::Low => 'Baixa',
            self::Medium => 'Média',
            self::High => 'Alta',
            self::Critical => 'Crítica',
        };
    }

    public function weight(): int
    {
        return match ($this) {
            self::Low => 1,
            self::Medium => 2,
            self::High => 3,
            self::Critical => 4,
        };
    }

    public static function normalize(string $value): self
    {
        return match (strtolower($value)) {
            'baixa' => self::Low,
            'média', 'media' => self::Medium,
            'alta' => self::High,
            'crítica', 'critica' => self::Critical,
            default => self::Medium,
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
