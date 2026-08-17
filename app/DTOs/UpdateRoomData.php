<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class UpdateRoomData
{
    public function __construct(
        public ?string $name = null,
        public ?string $code = null,
        public ?string $location = null,
        public ?bool $active = null,
        public ?string $building = null,
        public ?string $floor = null,
        public ?int $capacity = null,
        public ?string $description = null,
        public ?string $notes = null,
    ) {
        if ($this->name !== null && trim($this->name) === '') {
            throw new \InvalidArgumentException('O nome da sala não pode ser uma string vazia.');
        }

        if ($this->code !== null && trim($this->code) === '') {
            throw new \InvalidArgumentException('O código da sala não pode ser uma string vazia.');
        }

        if ($this->capacity !== null && $this->capacity < 0) {
            throw new \InvalidArgumentException('A capacidade da sala não pode ser negativa.');
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
            code: self::parseCode($payload['code'] ?? null),
            location: self::parseNullableString($payload['location'] ?? null),
            active: self::parseNullableBool($payload['active'] ?? null),
            building: self::parseNullableString($payload['building'] ?? null),
            floor: self::parseNullableString($payload['floor'] ?? null),
            capacity: self::parseNullableInt($payload['capacity'] ?? null),
            description: self::parseNullableString($payload['description'] ?? null),
            notes: self::parseNullableString($payload['notes'] ?? null),
        );
    }

    /**
     * Sanitiza strings opcionais, convertendo "" ou apenas espaços em null.
     */
    private static function parseNullableString(mixed $value): ?string
    {
        if (! is_string($value)) {
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
     * Sanitiza valores inteiros opcionais, convertendo "" ou inválidos para null.
     */
    private static function parseNullableInt(mixed $value): ?int
    {
        $parsed = filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

        return $parsed !== false && $parsed >= 0 ? $parsed : null;
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
     * Devolve apenas os campos efetivamente preenchidos para atualização dinâmica no Eloquent.
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'code' => $this->code,
            'location' => $this->location,
            'active' => $this->active,
            'building' => $this->building,
            'floor' => $this->floor,
            'capacity' => $this->capacity,
            'description' => $this->description,
            'notes' => $this->notes,
        ], static fn (mixed $value): bool => $value !== null);
    }

    /**
     * Verifica se foi enviado pelo menos um campo para ser atualizado.
     */
    public function hasUpdates(): bool
    {
        return ! empty($this->toArray());
    }
}
