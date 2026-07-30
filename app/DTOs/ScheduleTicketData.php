<?php

namespace App\DTOs;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;

final readonly class ScheduleTicketData
{
    public function __construct(
        public CarbonImmutable $scheduledAt,
        public ?CarbonImmutable $scheduledEnd = null,
    ) {
        if ($this->scheduledEnd !== null && $this->scheduledEnd->isBefore($this->scheduledAt)) {
            throw new \InvalidArgumentException('A data de fim do agendamento não pode ser anterior à data de início.');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        $scheduledAt = self::parseDate($payload['scheduled_at'] ?? null);

        if ($scheduledAt === null) {
            throw new \InvalidArgumentException('A data de agendamento (scheduled_at) é obrigatória e deve ser válida.');
        }

        return new self(
            scheduledAt: $scheduledAt,
            scheduledEnd: self::parseDate($payload['scheduled_end'] ?? null),
        );
    }

    /**
     * Converte strings, instâncias de DateTime ou inteiros (timestamps) para CarbonImmutable.
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
     * Converte o DTO para array pronto a utilizar em queries ou Eloquent.
     */
    public function toArray(): array
    {
        return [
            'scheduled_at' => $this->scheduledAt->toDateTimeString(),
            'scheduled_end' => $this->scheduledEnd?->toDateTimeString(),
        ];
    }
}
