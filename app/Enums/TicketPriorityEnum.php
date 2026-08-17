<?php

namespace App\Enums;

enum TicketPriorityEnum: string
{
    case Low = 'baixa';
    case Medium = 'média';
    case High = 'alta';
    case Critical = 'crítica';

    /**
     * Retorna todos os valores raw do Enum num array simples.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna todos os valores aceites, incluindo variações sem acentuação.
     */
    public static function acceptedValues(): array
    {
        return [
            ...self::values(),
            'media',
            'critica',
        ];
    }

    /**
     * Retorna a descrição legível em Português para a UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::Low => __('tickets.Baixa'),
            self::Medium => __('common.Média'),
            self::High => __('tickets.Alta'),
            self::Critical => __('common.Crítica'),
        };
    }

    /**
     * Cor indicativa para badges/tabelas no frontend.
     */
    public function color(): string
    {
        return match ($this) {
            self::Low => 'gray',
            self::Medium => 'info',
            self::High => 'warning',
            self::Critical => 'danger',
        };
    }

    /**
     * Ícone indicativo para representação visual.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Low => 'heroicon-o-arrow-down-short',
            self::Medium => 'heroicon-o-minus',
            self::High => 'heroicon-o-arrow-up-short',
            self::Critical => 'heroicon-o-fire',
        };
    }

    /**
     * Retorna a ponderação numérica para ordenação por prioridade.
     */
    public function weight(): int
    {
        return match ($this) {
            self::Low => 1,
            self::Medium => 2,
            self::High => 3,
            self::Critical => 4,
        };
    }

    /**
     * Tempo limite recomendado para resposta/resolução (SLA em horas).
     */
    public function slaHours(): int
    {
        return match ($this) {
            self::Low => 48,      // 2 dias
            self::Medium => 24,   // 1 dia
            self::High => 8,      // 8 horas
            self::Critical => 2,  // 2 horas
        };
    }

    /**
     * Indica se o ticket exige intervenção imediata (alerta de equipa/escalamento).
     */
    public function requiresImmediateAttention(): bool
    {
        return match ($this) {
            self::High, self::Critical => true,
            self::Low, self::Medium => false,
        };
    }

    /**
     * Converte com segurança entradas genéricas (com/sem acento, maiúsculas ou objetos).
     */
    public static function normalize(mixed $value): ?self
    {
        if ($value instanceof self) {
            return $value;
        }

        if (!is_string($value)) {
            return null;
        }

        $sanitized = mb_strtolower(trim($value));

        return match ($sanitized) {
            'baixa' => self::Low,
            'média', 'media' => self::Medium,
            'alta' => self::High,
            'crítica', 'critica' => self::Critical,
            default => self::tryFrom($sanitized),
        };
    }
}
