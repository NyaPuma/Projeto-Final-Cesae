<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class AssignTechnicianData
{
    public function __construct(
        public ?int $technicianId,
    ) {
        // Optional: defensive validation to ensure that if an ID is provided, it is a positive integer (> 0)
        if ($this->technicianId !== null && $this->technicianId <= 0) {
            throw new \InvalidArgumentException('Technician ID must be a positive integer.');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        $rawId = $payload['technician_id'] ?? null;

        // Trata strings vazias (''), null ou valores não numéricos como null
        $technicianId = filter_var($rawId, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

        return new self(
            technicianId: $technicianId && $technicianId > 0 ? $technicianId : null
        );
    }

    /**
     * Converte o DTO para array para uso em Models ou Services.
     */
    public function toArray(): array
    {
        return [
            'technician_id' => $this->technicianId,
        ];
    }
}
