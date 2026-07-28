<?php

namespace App\DTOs;

final readonly class AssignTechnicianData
{
    public function __construct(
        public ?int $technicianId,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            technicianId: isset($data['technician_id']) ? (int) $data['technician_id'] : null,
        );
    }
}
