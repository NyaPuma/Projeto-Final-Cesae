<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class CommentData
{
    public function __construct(
        public string $content,
    ) {
        if (trim($this->content) === '') {
            throw new \InvalidArgumentException('O conteúdo do comentário não pode estar vazio.');
        }
    }

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        $content = isset($payload['content']) ? trim((string) $payload['content']) : '';

        return new self(
            content: $content,
        );
    }

    /**
     * Converte o DTO para array simples.
     */
    public function toArray(): array
    {
        return [
            'content' => $this->content,
        ];
    }
}
