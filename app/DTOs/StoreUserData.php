<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class StoreUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?int $profileId = null,
        public bool $active = true,
    ) {
        if (trim($this->name) === '') {
            throw new \InvalidArgumentException('O nome do utilizador não pode estar vazio.');
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('O e-mail fornecido é inválido.');
        }

        if ($this->password === '') {
            throw new \InvalidArgumentException('A password não pode estar vazia.');
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
            name: trim((string) ($payload['name'] ?? '')),
            email: mb_strtolower(trim((string) ($payload['email'] ?? ''))),
            password: (string) ($payload['password'] ?? ''),
            profileId: self::parseNullableInt($payload['profile_id'] ?? null),
            active: self::parseBool($payload['active'] ?? true),
        );
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
     * Normaliza a entrada booleana (trata "true", "false", "1", "0", "on", etc.).
     */
    private static function parseBool(mixed $value): bool
    {
        if ($value === null) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Converte o DTO para array pronto a utilizar no Eloquent.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'profile_id' => $this->profileId,
            'active' => $this->active,
        ];
    }
}
