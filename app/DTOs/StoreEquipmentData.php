<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class StoreEquipmentData
{
    public function __construct(
        public string $name,
        public string $serial,
        public ?int $roomId = null,
        public ?int $categoryId = null,
        public bool $active = true,
    ) {
        if (trim($this->name) === '') {
            throw new \InvalidArgumentException('O nome do equipamento não pode estar vazio.');
        }

        if (trim($this->serial) === '') {
            throw new \InvalidArgumentException('O número de série não pode estar vazio.');
        }

        if ($this->roomId !== null && $this->roomId <= 0) {
            throw new \InvalidArgumentException('O ID da sala deve ser um número inteiro positivo.');
        }

        if ($this->categoryId !== null && $this->categoryId <= 0) {
            throw new \InvalidArgumentException('O ID da categoria deve ser um número inteiro positivo.');
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
            serial: strtoupper(trim((string) ($payload['serial'] ?? ''))),
            roomId: self::parseNullableInt($payload['room_id'] ?? null),
            categoryId: self::parseNullableInt($payload['category_id'] ?? null),
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
            'serial' => $this->serial,
            'room_id' => $this->roomId,
            'category_id' => $this->categoryId,
            'active' => $this->active,
        ];
    }
}
