<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class UpdateUserData
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $password = null,
        public ?int $profileId = null,
        public ?bool $active = null,
    ) {
        if ($this->name !== null && trim($this->name) === '') {
            throw new \InvalidArgumentException('O nome do utilizador não pode ser uma string vazia.');
        }

        if ($this->email !== null && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('O formato do e-mail fornecido é inválido.');
        }

        if ($this->profileId !== null && $this->profileId <= 0) {
            throw new \InvalidArgumentException('O ID do perfil deve ser um número inteiro positivo.');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        return new self(
            name: self::parseNullableString($payload['name'] ?? null),
            email: self::parseEmail($payload['email'] ?? null),
            password: self::parsePassword($payload['password'] ?? null),
            profileId: self::parseNullableInt($payload['profile_id'] ?? null),
            active: self::parseNullableBool($payload['active'] ?? null),
        );
    }

    /**
     * Sanitiza strings opcionais, convertendo "" ou apenas espaços em null.
     */
    private static function parseNullableString(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed !== '' ? $trimmed : null;
    }

    /**
     * Sanitiza e converte o e-mail para minúsculas caso seja fornecido.
     */
    private static function parseEmail(mixed $value): ?string
    {
        $string = self::parseNullableString($value);

        return $string !== null ? mb_strtolower($string) : null;
    }

    /**
     * Garante que passwords em branco ("") sejam convertidas para null (preserva espaços internos).
     */
    private static function parsePassword(mixed $value): ?string
    {
        if (!is_string($value) || $value === '') {
            return null;
        }

        return $value;
    }

    /**
     * Sanitiza IDs inteiros opcionais, convertendo "", 0 ou valores inválidos para null.
     */
    private static function parseNullableInt(mixed $value): ?int
    {
        $parsed = filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

        return $parsed && $parsed > 0 ? $parsed : null;
    }

    /**
     * Normaliza a entrada booleana sem forçar um valor padrão caso seja null.
     */
    private static function parseNullableBool(mixed $value): ?bool
    {
        if ($value === null || $value === '') {
            return null;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            ?? filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Verifica se foi fornecida uma nova password válida.
     */
    public function hasPassword(): bool
    {
        return $this->password !== null;
    }

    /**
     * Devolve os campos preenchidos para atualização no Eloquent (exclui a password por segurança).
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'profile_id' => $this->profileId,
            'active' => $this->active,
        ], static fn (mixed $value): bool => $value !== null);
    }

    /**
     * Verifica se existe pelo menos um campo para ser atualizado (incluindo password).
     */
    public function hasUpdates(): bool
    {
        return $this->hasPassword() || !empty($this->toArray());
    }
}
