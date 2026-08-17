<?php

namespace App\Enums;

enum BudgetStatusEnum: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    /**
     * Retorna todos os valores raw do Enum num array simples (ideal para validações Laravel).
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna a descrição legível em Português para UI e relatórios.
     */
    public function label(): string
    {
        return match ($this) {
            self::Pending => __('common.Pendente'),
            self::Approved => __('common.Aprovado'),
            self::Rejected => __('common.Rejeitado'),
        };
    }

    /**
     * Cor indicativa para badges/tabelas no frontend (ex: Filament, Tailwind, Bootstrap).
     */
    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }

    /**
     * Ícone indicativo para representação visual.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Pending => 'heroicon-o-clock',
            self::Approved => 'heroicon-o-check-circle',
            self::Rejected => 'heroicon-o-x-circle',
        };
    }

    /**
     * Indica se o orçamento já atingiu um estado terminal (aprovado ou rejeitado).
     */
    public function isFinal(): bool
    {
        return match ($this) {
            self::Approved, self::Rejected => true,
            self::Pending => false,
        };
    }

    /**
     * Valida se é possível transitar de estado.
     */
    public function canTransitionTo(self $target): bool
    {
        return match ($this) {
            self::Pending => true, // De pendente pode passar a qualquer estado
            self::Approved, self::Rejected => false, // Estados finais não transitam diretamente
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
