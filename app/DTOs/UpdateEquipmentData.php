<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class UpdateEquipmentData
{
    public function __construct(
        public ?string $name = null,
        public ?string $serial = null,
        public ?int $roomId = null,
        public ?int $categoryId = null,
        public ?bool $active = null,
        public ?string $assetTag = null,
        public ?string $brand = null,
        public ?string $model = null,
        public ?string $manufacturer = null,
        public ?string $purchaseDate = null,
        public ?string $warrantyUntil = null,
        public ?string $status = null,
        public ?string $notes = null,
    ) {
        if ($this->name !== null && trim($this->name) === '') {
            throw new \InvalidArgumentException('O nome do equipamento não pode ser uma string vazia.');
        }

        if ($this->serial !== null && trim($this->serial) === '') {
            throw new \InvalidArgumentException('O número de série não pode ser uma string vazia.');
        }

        if ($this->roomId !== null && $this->roomId <= 0) {
            throw new \InvalidArgumentException('O ID da sala deve ser um número inteiro positivo.');
        }

        if ($this->categoryId !== null && $this->categoryId <= 0) {
            throw new \InvalidArgumentException('O ID da categoria deve ser um número inteiro positivo.');
        }

        if ($this->status !== null && ! in_array($this->status, StoreEquipmentData::STATUSES, true)) {
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
            name: self::parseNullableString($payload['name'] ?? null),
            serial: self::parseSerial($payload['serial'] ?? null),
            roomId: self::parseNullableInt($payload['room_id'] ?? null),
            categoryId: self::parseNullableInt($payload['category_id'] ?? null),
            active: self::parseNullableBool($payload['active'] ?? null),
            assetTag: self::parseNullableString($payload['asset_tag'] ?? null),
            brand: self::parseNullableString($payload['brand'] ?? null),
            model: self::parseNullableString($payload['model'] ?? null),
            manufacturer: self::parseNullableString($payload['manufacturer'] ?? null),
            purchaseDate: self::parseNullableString($payload['purchase_date'] ?? null),
            warrantyUntil: self::parseNullableString($payload['warranty_until'] ?? null),
            status: in_array($payload['status'] ?? null, StoreEquipmentData::STATUSES, true)
                ? $payload['status']
                : null,
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
     * Sanitiza e converte o número de série para maiúsculas caso seja fornecido.
     */
    private static function parseSerial(mixed $value): ?string
    {
        $string = self::parseNullableString($value);

        return $string !== null ? strtoupper($string) : null;
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
     * Devolve apenas os campos preenchidos para atualização dinâmica via Eloquent.
     */
    public function toArray(): array
    {
        return array_filter([
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
