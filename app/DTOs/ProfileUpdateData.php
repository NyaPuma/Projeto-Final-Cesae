<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class ProfileUpdateData
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
    ) {
        if ($this->email !== null && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('O formato do e-mail fornecido é inválido.');
        }

        if ($this->name !== null && trim($this->name) === '') {
            throw new \InvalidArgumentException('O nome não pode ser composto apenas por espaços.');
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
        );
    }

    /**
     * Limpa espaços e converte strings vazias para null.
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
     * Sanitiza e converte o e-mail para minúsculas.
     */
    private static function parseEmail(mixed $value): ?string
    {
        $string = self::parseNullableString($value);

        return $string !== null ? mb_strtolower($string) : null;
    }

    /**
     * Devolve apenas os campos efetivamente preenchidos para não apagar dados no Eloquent.
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
        ], static fn (mixed $value): bool => $value !== null);
    }

    /**
     * Verifica se existe pelo menos um campo para atualizar.
     */
    public function hasChanges(): bool
    {
        return $this->name !== null || $this->email !== null;
    }
}
