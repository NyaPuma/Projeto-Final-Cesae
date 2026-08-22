<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Immutable value object representing and manipulating monetary values safely.
 */
final readonly class Money
{
    private int $amount;
    private string $currency;

    /**
     * Creates a new Money instance from an amount in cents and its currency.
     *
     * @param int $amount Amount in cents
     * @param string $currency Three-letter ISO currency code (e.g. EUR)
     * @throws InvalidArgumentException
     */
    public function __construct(int $amount, string $currency = 'EUR')
    {
        $this->validateAmount($amount);
        $this->validateCurrency($currency);
        $this->amount = $amount;
        $this->currency = strtoupper($currency);
    }

    /**
     * Validates that the provided amount is valid (non-negative).
     *
     * @param int $amount
     * @throws InvalidArgumentException
     */
    private function validateAmount(int $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount cannot be negative');
        }
    }

    /**
     * Validates that the currency is a valid 3-letter ISO code.
     *
     * @param string $currency
     * @throws InvalidArgumentException
     */
    private function validateCurrency(string $currency): void
    {
        if (strlen($currency) !== 3) {
            throw new InvalidArgumentException('Currency must be a 3-letter ISO code');
        }
    }

    /**
     * Creates a Money instance from a decimal (float) value.
     *
     * @param float $amount
     * @param string $currency
     * @return self
     */
    public static function fromFloat(float $amount, string $currency = 'EUR'): self
    {
        return new self((int) round($amount * 100), $currency);
    }

    /**
     * Creates a zero-value Money instance.
     *
     * @param string $currency
     * @return self
     */
    public static function zero(string $currency = 'EUR'): self
    {
        return new self(0, $currency);
    }

    /**
     * Returns the amount in cents.
     *
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * Returns the currency code.
     *
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * Converts the amount to decimal (float) format.
     *
     * @return float
     */
    public function toFloat(): float
    {
        return $this->amount / 100;
    }

    /**
     * Returns the value formatted with two decimal places and the currency.
     *
     * @return string
     */
    public function formatted(): string
    {
        return number_format($this->toFloat(), 2) . ' ' . $this->currency;
    }

    /**
     * Adds another monetary amount, validating currency compatibility.
     *
     * @param Money $other
     * @return self
     * @throws InvalidArgumentException
     */
    public function add(Money $other): self
    {
        $this->ensureSameCurrency($other);

        return new self($this->amount + $other->amount, $this->currency);
    }

    /**
     * Subtracts another monetary amount, validating currency compatibility.
     *
     * @param Money $other
     * @return self
     * @throws InvalidArgumentException
     */
    public function subtract(Money $other): self
    {
        $this->ensureSameCurrency($other);

        return new self($this->amount - $other->amount, $this->currency);
    }

    /**
     * Multiplies the amount by a numeric factor.
     *
     * @param float $factor
     * @return self
     */
    public function multiply(float $factor): self
    {
        return new self((int) round($this->amount * $factor), $this->currency);
    }

    /**
     * Checks whether this amount and currency are equal to another Money object.
     *
     * @param Money $other
     * @return bool
     */
    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount && $this->currency === $other->currency;
    }

    /**
     * Checks whether the amount is zero.
     *
     * @return bool
     */
    public function isZero(): bool
    {
        return $this->amount === 0;
    }

    /**
     * Checks whether the amount is strictly positive.
     *
     * @return bool
     */
    public function isPositive(): bool
    {
        return $this->amount > 0;
    }

    /**
     * Ensures both Money objects use the same currency.
     *
     * @param Money $other
     * @throws InvalidArgumentException
     */
    private function ensureSameCurrency(Money $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException('Cannot operate on different currencies');
        }
    }

    /**
     * Returns the formatted string representation of this monetary object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->formatted();
    }
}
