<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class CloseTicketData
{
    public function __construct(
        public float $actualCost,
        public ?string $report = null,
        public bool $force = false,
    ) {
        if ($this->actualCost < 0) {
            throw new \InvalidArgumentException('The actual cost for closing a ticket cannot be negative.');
        }
    }

    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        // Sanitize report: trim whitespace and convert empty string to null
        $rawReport = isset($payload['report']) ? trim((string) $payload['report']) : null;
        $report = $rawReport !== '' ? $rawReport : null;

        // Normalize cost to 2 decimal places
        $actualCost = self::parseCost($payload['actual_cost'] ?? 0);

        // Flexible boolean coercion for 'force' flag ("true", "1", true, etc.)
        $force = filter_var($payload['force'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return new self(
            actualCost: $actualCost,
            report: $report,
            force: $force,
        );
    }

    /**
     * Sanitize monetary input to a precise float (2 decimal places).
     * Handles comma-separated decimal strings (e.g. "150,50").
     */
    private static function parseCost(mixed $value): float
    {
        if (is_numeric($value)) {
            return round((float) $value, 2);
        }

        if (is_string($value)) {
            $cleaned = str_replace(',', '.', preg_replace('/[^\d,.]]/', '', $value));

            if (is_numeric($cleaned)) {
                return round((float) $cleaned, 2);
            }
        }

        return 0.0;
    }

    public function toArray(): array
    {
        return [
            'actual_cost' => $this->actualCost,
            'report' => $this->report,
            'force' => $this->force,
        ];
    }
}
