<?php

namespace App\Domain\Ticket\ValueObjects;

use Carbon\CarbonInterface;
use JsonSerializable;
use Stringable;

final readonly class BudgetPauseMinutes implements Stringable, JsonSerializable
{
    public function __construct(
        public ?CarbonInterface $requestedAt,
        public ?CarbonInterface $decidedAt,
    ) {}

    /**
     * Construtor nomeado para sintaxe fluida.
     */
    public static function make(?CarbonInterface $requestedAt, ?CarbonInterface $decidedAt): self
    {
        return new self($requestedAt, $decidedAt);
    }

    /**
     * Devolve o total de minutos decorridos na pausa.
     * Retorna 0 se a pausa não foi concluída ou se os dados forem inválidos.
     */
    public function value(): int
    {
        if ($this->requestedAt === null || $this->decidedAt === null) {
            return 0;
        }

        // Garante que a data de decisão não é anterior ao pedido
        if ($this->decidedAt->isBefore($this->requestedAt)) {
            return 0;
        }

        return (int) $this->requestedAt->diffInMinutes($this->decidedAt);
    }

    /**
     * Converte o valor para horas arredondado a 2 casas decimais.
     */
    public function toHours(): float
    {
        return round($this->value() / 60, 2);
    }

    /**
     * Indica se a pausa do orçamento se encontra pendente de decisão.
     */
    public function isPending(): bool
    {
        return $this->requestedAt !== null && $this->decidedAt === null;
    }

    /**
     * Indica se não existe tempo de pausa acumulado.
     */
    public function isEmpty(): bool
    {
        return $this->value() === 0;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    public function jsonSerialize(): int
    {
        return $this->value();
    }
}
