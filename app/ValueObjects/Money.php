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
     * @param  int  $amount  Amount in cents
     * @param  string  $currency  Three-letter ISO currency code (e.g. EUR)
     *
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
     */
    public static function fromFloat(float $amount, string $currency = 'EUR'): self
    {
        return new self((int) round($amount * 100), $currency);
    }

    /**
     * Creates a zero-value Money instance.
     */
    public static function zero(string $currency = 'EUR'): self
    {
        return new self(0, $currency);
    }

    /**
     * Returns the amount in cents.
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * Returns the currency code.
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * Converts the amount to decimal (float) format.
     */
    public function toFloat(): float
    {
        return $this->amount / 100;
    }

    /**
     * Returns the value formatted with two decimal places and the currency.
     */
    public function formatted(): string
    {
        return number_format($this->toFloat(), 2).' '.$this->currency;
    }

    /**
     * Adds another monetary amount, validating currency compatibility.
     *
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
     * @throws InvalidArgumentException
     */
    public function subtract(Money $other): self
    {
        $this->ensureSameCurrency($other);

        return new self($this->amount - $other->amount, $this->currency);
    }

    /**
     * Multiplies the amount by a numeric factor.
     */
    public function multiply(float $factor): self
    {
        return new self((int) round($this->amount * $factor), $this->currency);
    }

    /**
     * Checks whether this amount and currency are equal to another Money object.
     */
    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount && $this->currency === $other->currency;
    }

    /**
     * Checks whether the amount is zero.
     */
    public function isZero(): bool
    {
        return $this->amount === 0;
    }

    /**
     * Checks whether the amount is strictly positive.
     */
    public function isPositive(): bool
    {
        return $this->amount > 0;
    }

    /**
     * Ensures both Money objects use the same currency.
     *
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
     */
    public function __toString(): string
    {
        return $this->formatted();
    }
}
