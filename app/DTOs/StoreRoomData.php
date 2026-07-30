<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class StoreRoomData
{
    public function __construct(
        public string $name,
        public ?string $code = null,
        public ?string $location = null,
        public bool $active = true,
    ) {
        if (trim($this->name) === '') {
            throw new \InvalidArgumentException('O nome da sala não pode estar vazio.');
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
            code: self::parseCode($payload['code'] ?? null),
            location: self::parseNullableString($payload['location'] ?? null),
            active: self::parseBool($payload['active'] ?? true),
        );
    }

    /**
     * Sanitiza strings opcionais, convertendo "" ou espaços para null.
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
     * Sanitiza e converte o código da sala para maiúsculas (ex: "lab-1" -> "LAB-1").
     */
    private static function parseCode(mixed $value): ?string
    {
        $string = self::parseNullableString($value);

        return $string !== null ? strtoupper($string) : null;
    }

    /**
     * Normaliza a entrada booleana (trata "true", "1", "on", etc.).
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
            'code' => $this->code,
            'location' => $this->location,
            'active' => $this->active,
        ];
    }
}
