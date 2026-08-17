<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Ticket;
use App\Services\AIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

final class GenerateAiRecommendationJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Número máximo de tentativas antes de considerar o job como falhado.
     */
    public int $tries = 3;

    /**
     * Tempo de espera (em segundos) entre cada tentativa (backoff exponencial).
     *
     * @var array<int, int>
     */
    public array $backoff = [10, 30, 60];

    /**
     * Tempo máximo (em segundos) que a chamada à API de IA pode demorar.
     */
    public int $timeout = 60;

    public function __construct(
        public readonly Ticket $ticket,
    ) {}

    /**
     * Garante que apenas uma recomendação é gerada por ticket de cada vez,
     * evitando chamadas duplicadas ao serviço de IA (idempotência).
     */
    public function uniqueId(): string
    {
        return (string) $this->ticket->id;
    }

    /**
     * Mantém o lock de unicidade durante 2 minutos após o término do job.
     */
    public function uniqueFor(): int
    {
        return 120;
    }

    public function handle(AIService $aiService): void
    {
        // 1. Obtém a recomendação do serviço de IA
        $recommendation = $aiService->recomendarTecnico($this->ticket);

        try {
            // 2. Persiste o resultado no modelo de Ticket
            $this->ticket->update([
                'recommended_technician_id' => $recommendation['tecnico_id'] ?? null,
                'ai_recommendation_reason' => $recommendation['justificacao'] ?? null,
                'ai_processed_at' => now(),
            ]);
        } catch (Throwable $e) {
            Log::warning("Não foi possível persistir a recomendação de IA do Ticket #{$this->ticket->id}.", [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Trata o insucesso do Job caso a API de IA fique indisponível.
     */
    public function failed(?Throwable $exception): void
    {
        logger()->error("Falha ao gerar recomendação de IA para o Ticket #{$this->ticket->id}", [
            'exception' => $exception?->getMessage(),
        ]);

        try {
            $this->ticket->update([
                'ai_processed_at' => now(),
                'ai_recommendation_reason' => 'Não foi possível obter uma recomendação automática no momento.',
            ]);
        } catch (Throwable $e) {
            Log::warning("Não foi possível registar a falha de IA no Ticket #{$this->ticket->id}.", [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
