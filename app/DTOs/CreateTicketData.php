<?php

namespace App\DTOs;

use App\Enums\TicketPriorityEnum;
use Illuminate\Foundation\Http\FormRequest;

final readonly class CreateTicketData
{
    public function __construct(
        public string $title,
        public string $description,
        public TicketPriorityEnum $priority,
        public ?int $equipmentId = null,
        public ?int $roomId = null,
    ) {
        if (trim($this->title) === '') {
            throw new \InvalidArgumentException('O título do ticket não pode estar vazio.');
        }

        if (trim($this->description) === '') {
            throw new \InvalidArgumentException('A descrição do ticket não pode estar vazia.');
        }

        if ($this->equipmentId !== null && $this->equipmentId <= 0) {
            throw new \InvalidArgumentException('O ID do equipamento deve ser um número inteiro positivo.');
        }

        if ($this->roomId !== null && $this->roomId <= 0) {
            throw new \InvalidArgumentException('O ID da sala deve ser um número inteiro positivo.');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        // Normalização flexível do Enum de Prioridade
        $rawPriority = $payload['priority'] ?? TicketPriorityEnum::Low;
        $priority = $rawPriority instanceof TicketPriorityEnum
            ? $rawPriority
            : (method_exists(TicketPriorityEnum::class, 'normalize')
                ? TicketPriorityEnum::normalize($rawPriority)
                : TicketPriorityEnum::from($rawPriority));

        return new self(
            title: trim((string) ($payload['title'] ?? '')),
            description: trim((string) ($payload['description'] ?? '')),
            priority: $priority,
            equipmentId: self::parseNullableInt($payload['equipment_id'] ?? null),
            roomId: self::parseNullableInt($payload['room_id'] ?? null),
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
     * Converte o DTO para array pronto a utilizar no Eloquent / Service.
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority->value,
            'equipment_id' => $this->equipmentId,
            'room_id' => $this->roomId,
        ];
    }
}
