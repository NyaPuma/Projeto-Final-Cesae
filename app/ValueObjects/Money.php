<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Value Object que representa e manipula valores monetários de forma segura e imutável.
 */
final readonly class Money
{
    private int $amount;
    private string $currency;

    /**
     * Cria uma nova instância de Money com o montante em cêntimos e a respetiva moeda.
     *
     * @param int $amount Montante em cêntimos
     * @param string $currency Código ISO de 3 letras da moeda (ex: EUR)
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
     * Valida se o montante fornecido é válido (não negativo).
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
     * Valida se a moeda é um código ISO válido de 3 letras.
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
     * Cria uma instância de Money a partir de um valor decimal (float).
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
     * Cria uma instância de Money com valor zero.
     *
     * @param string $currency
     * @return self
     */
    public static function zero(string $currency = 'EUR'): self
    {
        return new self(0, $currency);
    }

    /**
     * Retorna o montante em cêntimos.
     *
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * Retorna o código da moeda.
     *
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * Converte o montante para formato decimal (float).
     *
     * @return float
     */
    public function toFloat(): float
    {
        return $this->amount / 100;
    }

    /**
     * Retorna o valor formatado com duas casas decimais e a moeda.
     *
     * @return string
     */
    public function formatted(): string
    {
        return number_format($this->toFloat(), 2) . ' ' . $this->currency;
    }

    /**
     * Adiciona outro montante monetário, validando a compatibilidade de moedas.
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
     * Subtrai outro montante monetário, validando a compatibilidade de moedas.
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
     * Multiplica o montante por um fator numérico.
     *
     * @param float $factor
     * @return self
     */
    public function multiply(float $factor): self
    {
        return new self((int) round($this->amount * $factor), $this->currency);
    }

    /**
     * Verifica se este montante e moeda são iguais a outro objeto Money.
     *
     * @param Money $other
     * @return bool
     */
    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount && $this->currency === $other->currency;
    }

    /**
     * Verifica se o montante é zero.
     *
     * @return bool
     */
    public function isZero(): bool
    {
        return $this->amount === 0;
    }

    /**
     * Verifica se o montante é estritamente positivo.
     *
     * @return bool
     */
    public function isPositive(): bool
    {
        return $this->amount > 0;
    }

    /**
     * Assegura que ambos os objetos Money utilizam a mesma moeda.
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
     * Retorna a representação em string do objeto monetário formatado.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->formatted();
    }
}
