<?php

namespace App\Enums;

enum PublicTicketProblemTypeEnum: string
{
    case Breakdown = 'avaria';
    case Preventive = 'manutencao_preventiva';
    case Consumables = 'falta_consumiveis';
    case Other = 'outro';

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
            self::Breakdown => __('common.Avaria'),
            self::Preventive => __('maintenance_plan.Manutenção Preventiva'),
            self::Consumables => __('common.Falta de Consumíveis'),
            self::Other => __('common.Outro'),
        };
    }

    /**
     * Converte o tipo de problema na prioridade de ticket correspondente.
     */
    public function priority(): TicketPriorityEnum
    {
        return match ($this) {
            self::Breakdown => TicketPriorityEnum::High,
            self::Preventive => TicketPriorityEnum::Low,
            self::Consumables => TicketPriorityEnum::Medium,
            self::Other => TicketPriorityEnum::Medium,
        };
    }

    /**
     * Emoji representativo para o seletor do formulário público.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Breakdown => '⚙️',
            self::Preventive => '🔧',
            self::Consumables => '🧰',
            self::Other => '📝',
        };
    }

    /**
     * Converte com segurança entradas genéricas (com/sem acento, maiúsculas).
     */
    public static function normalize(mixed $value): ?self
    {
        if ($value instanceof self) {
            return $value;
        }

        if (! is_string($value)) {
            return null;
        }

        $sanitized = mb_strtolower(trim($value));

        return match ($sanitized) {
            'avaria' => self::Breakdown,
            'manutencao_preventiva', 'manutenção preventiva', 'manutencao preventiva' => self::Preventive,
            'falta_consumiveis', 'falta de consumíveis', 'falta de consumiveis' => self::Consumables,
            'outro' => self::Other,
            default => self::tryFrom($sanitized),
        };
    }
}
