<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class PasswordChangeData
{
    public function __construct(
        public string $currentPassword,
        public string $newPassword,
    ) {
        if ($this->currentPassword === '') {
            throw new \InvalidArgumentException('A password atual é obrigatória.');
        }

        if ($this->newPassword === '') {
            throw new \InvalidArgumentException('A nova password é obrigatória.');
        }

        if ($this->currentPassword === $this->newPassword) {
            throw new \InvalidArgumentException('A nova password deve ser diferente da password atual.');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        return new self(
            currentPassword: (string) ($payload['current_password'] ?? ''),
            newPassword: (string) ($payload['new_password'] ?? ''),
        );
    }

    /**
     * Converte o DTO para array.
     */
    public function toArray(): array
    {
        return [
            'current_password' => $this->currentPassword,
            'new_password' => $this->newPassword,
        ];
    }
}
