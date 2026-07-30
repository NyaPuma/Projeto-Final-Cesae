<?php

namespace App\DTOs;

use App\Enums\TicketPriorityEnum;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;

final readonly class TicketFilters
{
    public function __construct(
        public ?string $query = null,
        public ?TicketPriorityEnum $priority = null,
        public ?string $status = null,
        public ?CarbonImmutable $dateFrom = null,
        public ?CarbonImmutable $dateTo = null,
        public ?int $userId = null,
        public ?int $technicianId = null,
        public ?int $equipmentId = null,
        public ?int $roomId = null,
    ) {
        if ($this->dateFrom !== null && $this->dateTo !== null && $this->dateFrom->isAfter($this->dateTo)) {
            throw new \InvalidArgumentException('A data inicial (dateFrom) não pode ser posterior à data final (dateTo).');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest (tipicamente vindo da Query String).
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        return new self(
            query: self::parseNullableString($payload['q'] ?? $payload['query'] ?? null),
            priority: self::parsePriority($payload['priority'] ?? null),
            status: self::parseNullableString($payload['status'] ?? null),
            dateFrom: self::parseDate($payload['date_from'] ?? null),
            dateTo: self::parseDate($payload['date_to'] ?? null),
            userId: self::parseNullableInt($payload['user_id'] ?? null),
            technicianId: self::parseNullableInt($payload['technician_id'] ?? null),
            equipmentId: self::parseNullableInt($payload['equipment_id'] ?? null),
            roomId: self::parseNullableInt($payload['room_id'] ?? null),
        );
    }

    /**
     * Tenta converter a entrada para o Enum de prioridade de forma segura.
     */
    private static function parsePriority(mixed $value): ?TicketPriorityEnum
    {
        if ($value instanceof TicketPriorityEnum) {
            return $value;
        }

        if (empty($value) || (!is_string($value) && !is_int($value))) {
            return null;
        }

        if (method_exists(TicketPriorityEnum::class, 'normalize')) {
            return TicketPriorityEnum::normalize($value);
        }

        return TicketPriorityEnum::tryFrom($value);
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
     * Converte entradas numéricas de query string para inteiros válidos (> 0).
     */
    private static function parseNullableInt(mixed $value): ?int
    {
        $parsed = filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

        return $parsed && $parsed > 0 ? $parsed : null;
    }

    /**
     * Converte datas recebidas para instâncias de CarbonImmutable.
     */
    private static function parseDate(mixed $value): ?CarbonImmutable
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof CarbonImmutable) {
            return $value;
        }

        if ($value instanceof \DateTimeInterface) {
            return CarbonImmutable::instance($value);
        }

        try {
            return CarbonImmutable::parse((string) $value);
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Devolve apenas os filtros ativos (não nulos) para aplicação dinâmica em queries Eloquent.
     */
    public function toArray(): array
    {
        return array_filter([
            'q' => $this->query,
            'priority' => $this->priority?->value ?? $this->priority,
            'status' => $this->status,
            'date_from' => $this->dateFrom?->toDateString(),
            'date_to' => $this->dateTo?->toDateString(),
            'user_id' => $this->userId,
            'technician_id' => $this->technicianId,
            'equipment_id' => $this->equipmentId,
            'room_id' => $this->roomId,
        ], static fn (mixed $value): bool => $value !== null);
    }

    /**
     * Verifica se existe pelo menos um filtro ativo na pesquisa.
     */
    public function hasFilters(): bool
    {
        return !empty($this->toArray());
    }
}
