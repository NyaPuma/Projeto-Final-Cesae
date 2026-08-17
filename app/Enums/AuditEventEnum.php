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

    /**
     * Retorna todos os valores raw do Enum num array simples.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna a descrição legível do evento em Português para UI e relatórios.
     */
    public function label(): string
    {
        return match ($this) {
            self::Created => __('auth.Registo Criado'),
            self::Updated => __('auth.Registo Atualizado'),
            self::Deleted => __('auth.Registo Eliminado'),
            self::Login => __('auth.Início de Sessão'),
            self::Logout => __('auth.Fim de Sessão'),
            self::PasswordChanged => __('auth.Palavra-passe Alterada'),
        };
    }

    /**
     * Cor indicativa para badges/tabelas no frontend ou painéis como Filament/Nova.
     */
    public function color(): string
    {
        return match ($this) {
            self::Created => 'success',
            self::Updated => 'info',
            self::Deleted => 'danger',
            self::Login, self::Logout => 'gray',
            self::PasswordChanged => 'warning',
        };
    }

    /**
     * Verifica se o evento pertence ao grupo de segurança/autenticação.
     */
    public function isAuthEvent(): bool
    {
        return match ($this) {
            self::Login, self::Logout, self::PasswordChanged => true,
            default => false,
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
