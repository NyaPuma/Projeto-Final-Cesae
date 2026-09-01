<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Immutable value object representing and validating a serial number.
 */
final readonly class SerialNumber
{
    private string $value;

    /**
     * Creates a new SerialNumber instance after validation and normalization.
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $serial)
    {
        $this->validate($serial);
        $this->value = strtoupper(trim($serial));
    }

    /**
     * Validates that the serial number meets format, length, and character requirements.
     *
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
     * Returns the normalized serial number value.
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Checks whether this serial number is exactly equal to another SerialNumber.
     */
    public function equals(SerialNumber $other): bool
    {
        return $this->value === $other->value;
    }

    /**
     * Returns the string representation of the serial number.
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
