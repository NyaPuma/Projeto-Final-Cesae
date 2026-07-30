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
            throw new \InvalidArgumentException('O custo real do fecho do ticket não pode ser negativo.');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        // Sanitização do relatório (limpa espaços e converte "" em null)
        $rawReport = isset($payload['report']) ? trim((string) $payload['report']) : null;
        $report = $rawReport !== '' ? $rawReport : null;

        // Normalização do custo real com 2 casas decimais
        $actualCost = self::parseCost($payload['actual_cost'] ?? 0);

        // Conversão flexível do flag 'force' (trata "true", "1", true, etc.)
        $force = filter_var($payload['force'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return new self(
            actualCost: $actualCost,
            report: $report,
            force: $force,
        );
    }

    /**
     * Sanitiza a entrada monetária para float preciso (2 casas decimais).
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

    /**
     * Converte o DTO para array pronto a utilizar no Eloquent / Service.
     */
    public function toArray(): array
    {
        return [
            'actual_cost' => $this->actualCost,
            'report' => $this->report,
            'force' => $this->force,
        ];
    }
}
