<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class StoreEquipmentData
{
    public const STATUSES = [
        'operacional',
        'manutenção',
        'avariado',
        'abatido',
    ];

    public function __construct(
        public string $name,
        public string $serial,
        public ?int $roomId = null,
        public ?int $categoryId = null,
        public bool $active = true,
        public ?string $assetTag = null,
        public ?string $brand = null,
        public ?string $model = null,
        public ?string $manufacturer = null,
        public ?string $purchaseDate = null,
        public ?string $warrantyUntil = null,
        public string $status = 'operacional',
        public ?string $notes = null,
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

        if (! in_array($this->status, self::STATUSES, true)) {
            throw new \InvalidArgumentException('O estado operacional do equipamento é inválido.');
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
            assetTag: self::parseNullableString($payload['asset_tag'] ?? null),
            brand: self::parseNullableString($payload['brand'] ?? null),
            model: self::parseNullableString($payload['model'] ?? null),
            manufacturer: self::parseNullableString($payload['manufacturer'] ?? null),
            purchaseDate: self::parseNullableString($payload['purchase_date'] ?? null),
            warrantyUntil: self::parseNullableString($payload['warranty_until'] ?? null),
            status: in_array($payload['status'] ?? 'operacional', self::STATUSES, true)
                ? $payload['status']
                : 'operacional',
            notes: self::parseNullableString($payload['notes'] ?? null),
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
            'asset_tag' => $this->assetTag,
            'brand' => $this->brand,
            'model' => $this->model,
            'manufacturer' => $this->manufacturer,
            'purchase_date' => $this->purchaseDate,
            'warranty_until' => $this->warrantyUntil,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}
