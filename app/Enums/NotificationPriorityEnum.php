<?php

namespace App\Enums;

enum NotificationPriorityEnum: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
    case Urgent = 'urgent';

    /**
     * Retorna todos os valores raw do Enum num array simples.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna a descrição legível em Português para a UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::Low => __('tickets.Baixa'),
            self::Normal => __('common.Normal'),
            self::High => __('tickets.Alta'),
            self::Urgent => __('tickets.Urgente'),
        };
    }

    /**
     * Cor indicativa para badges, toasts e alertas no frontend.
     */
    public function color(): string
    {
        return match ($this) {
            self::Low => 'gray',
            self::Normal => 'info',
            self::High => 'warning',
            self::Urgent => 'danger',
        };
    }

    /**
     * Ícone indicativo para representação visual.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Low => 'heroicon-o-arrow-down',
            self::Normal => 'heroicon-o-minus',
            self::High => 'heroicon-o-arrow-up',
            self::Urgent => 'heroicon-o-exclamation-triangle',
        };
    }

    /**
     * Retorna a ponderação numérica para ordenação por prioridade em filas ou queries.
     */
    public function weight(): int
    {
        return match ($this) {
            self::Low => 1,
            self::Normal => 2,
            self::High => 3,
            self::Urgent => 4,
        };
    }

    /**
     * Indica se a notificação requer envio imediato / contornar filas lentas.
     */
    public function isHighPriority(): bool
    {
        return match ($this) {
            self::High, self::Urgent => true,
            self::Low, self::Normal => false,
        };
    }

    /**
     * Tenta converter um valor genérico (string ou Enum) de forma segura.
     */
    public static function normalize(mixed $value): ?self
    {
        if ($value instanceof self) {
            return $value;
        }

        if (!is_string($value)) {
            return null;
        }

        return self::tryFrom(mb_strtolower(trim($value)));
    }
}
