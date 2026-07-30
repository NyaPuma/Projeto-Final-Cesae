<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Value Object que representa e valida um número de série de forma imutável.
 */
final readonly class SerialNumber
{
    private string $value;

    /**
     * Cria uma nova instância de SerialNumber após validação e normalização.
     *
     * @param string $serial
     * @throws InvalidArgumentException
     */
    public function __construct(string $serial)
    {
        $this->validate($serial);
        $this->value = strtoupper(trim($serial));
    }

    /**
     * Valida se o número de série cumpre os requisitos de formato, tamanho e caracteres permitidos.
     *
     * @param string $serial
     * @throws InvalidArgumentException
     */
    private function validate(string $serial): void
    {
        if (empty($serial)) {
            throw new InvalidArgumentException('Serial number cannot be empty');
        }

        if (strlen($serial) < 3) {
            throw new InvalidArgumentException('Serial number must be at least 3 characters');
        }

        if (! preg_match('/^[A-Z0-9\-]+$/', strtoupper($serial))) {
            throw new InvalidArgumentException('Serial number can only contain letters, numbers, and hyphens');
        }
    }

    /**
     * Retorna o valor normalizado do número de série.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Compara se este número de série é exatamente igual a outro objeto SerialNumber.
     *
     * @param SerialNumber $other
     * @return bool
     */
    public function equals(SerialNumber $other): bool
    {
        return $this->value === $other->value;
    }

    /**
     * Retorna a representação em string do número de série.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
