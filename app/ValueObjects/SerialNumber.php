<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final readonly class SerialNumber
{
    private string $value;

    public function __construct(string $serial)
    {
        $this->validate($serial);
        $this->value = strtoupper(trim($serial));
    }

    private function validate(string $serial): void
    {
        if (empty($serial)) {
            throw new InvalidArgumentException('Serial number cannot be empty');
        }

        if (strlen($serial) < 3) {
            throw new InvalidArgumentException('Serial number must be at least 3 characters');
        }

        if (!preg_match('/^[A-Z0-9\-]+$/', strtoupper($serial))) {
            throw new InvalidArgumentException('Serial number can only contain letters, numbers, and hyphens');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(SerialNumber $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
