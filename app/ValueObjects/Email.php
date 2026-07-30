<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Value Object que representa e valida um endereço de e-mail de forma imutável.
 */
final readonly class Email
{
    private string $value;

    /**
     * Cria uma nova instância de Email após validação e normalização.
     *
     * @param string $email
     * @throws InvalidArgumentException
     */
    public function __construct(string $email)
    {
        $this->validate($email);
        $this->value = strtolower(trim($email));
    }

    /**
     * Valida o formato do e-mail através de filtros nativos.
     *
     * @param string $email
     * @throws InvalidArgumentException
     */
    private function validate(string $email): void
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format: {$email}");
        }
    }

    /**
     * Retorna o valor normalizado do e-mail.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Retorna o domínio do e-mail.
     *
     * @return string
     */
    public function domain(): string
    {
        return substr(strrchr($this->value, '@'), 1);
    }

    /**
     * Retorna a parte local (username) do e-mail.
     *
     * @return string
     */
    public function localPart(): string
    {
        return strstr($this->value, '@', true);
    }

    /**
     * Compara se este e-mail é exatamente igual a outro objeto Email.
     *
     * @param Email $other
     * @return bool
     */
    public function equals(Email $other): bool
    {
        return $this->value === $other->value;
    }

    /**
     * Retorna a representação em string do e-mail.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
