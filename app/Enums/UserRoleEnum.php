<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case User = 'user';
    case Technician = 'technician';
    case Admin = 'admin';

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
            self::User => __('common.Utilizador'),
            self::Technician => __('common.Técnico'),
            self::Admin => __('common.Administrador'),
        };
    }

    /**
     * Cor indicativa para badges e elementos de perfil no frontend.
     */
    public function color(): string
    {
        return match ($this) {
            self::User => 'gray',
            self::Technician => 'info',
            self::Admin => 'purple',
        };
    }

    /**
     * Ícone indicativo para representação visual na UI.
     */
    public function icon(): string
    {
        return match ($this) {
            self::User => 'heroicon-o-user',
            self::Technician => 'heroicon-o-wrench-screwdriver',
            self::Admin => 'heroicon-o-shield-check',
        };
    }

    /**
     * Retorna o peso numérico do papel para verificação de hierarquia.
     */
    public function weight(): int
    {
        return match ($this) {
            self::User => 1,
            self::Technician => 2,
            self::Admin => 3,
        };
    }

    /**
     * Indica se o papel atual possui privilégios de Administrador.
     */
    public function isAdmin(): bool
    {
        return $this === self::Admin;
    }

    /**
     * Indica se o papel atual possui privilégios de Técnico.
     */
    public function isTechnician(): bool
    {
        return $this === self::Technician;
    }

    /**
     * Indica se o papel é de um utilizador comum.
     */
    public function isUser(): bool
    {
        return $this === self::User;
    }

    /**
     * Indica se o utilizador possui privilégios elevados (Técnico ou Admin).
     */
    public function hasElevatedPrivileges(): bool
    {
        return match ($this) {
            self::Technician, self::Admin => true,
            self::User => false,
        };
    }

    /**
     * Verifica se o papel atual tem permissões iguais ou superiores ao papel exigido.
     */
    public function hasAtLeastRole(self $requiredRole): bool
    {
        return $this->weight() >= $requiredRole->weight();
    }

    /**
     * Converte com segurança entradas genéricas (incluindo sinónimos em português ou objetos).
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
            'admin', 'administrador' => self::Admin,
            'technician', 'técnico', 'tecnico' => self::Technician,
            'user', 'utilizador', 'usuário', 'usuario' => self::User,
            default => self::tryFrom($sanitized),
        };
    }
}
