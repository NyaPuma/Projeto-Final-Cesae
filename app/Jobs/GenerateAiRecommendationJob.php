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

final class GenerateAiRecommendationJob implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Maximum number of attempts before the job is considered failed.
     */
    public int $tries = 3;

    /**
     * Wait time (in seconds) between each attempt (exponential backoff).
     *
     * @var array<int, int>
     */
    public array $backoff = [10, 30, 60];

    /**
     * Maximum time (in seconds) the AI API call can take.
     */
    public int $timeout = 60;

    public function __construct(
        public readonly Ticket $ticket,
    ) {}

    /**
     * Ensures only one recommendation is generated per ticket at a time,
     * preventing duplicate AI service calls (idempotency).
     */
    public function uniqueId(): string
    {
        return (string) $this->ticket->id;
    }

    /**
     * Keeps the uniqueness lock for 2 minutes after job completion.
     */
    public function uniqueFor(): int
    {
        return 120;
    }

    public function handle(AIService $aiService): void
    {
        // 1. Get recommendation from AI service
        $recommendation = $aiService->recommendTechnician($this->ticket);

        try {
            // 2. Persist result on Ticket model
            $this->ticket->update([
                'recommended_technician_id' => $recommendation['technician_id'] ?? null,
                'ai_recommendation_reason' => $recommendation['justification'],
                'ai_processed_at' => now(),
            ]);
        } catch (Throwable $e) {
            Log::warning("Could not persist AI recommendation for Ticket #{$this->ticket->id}.", [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Handles job failure when AI API becomes unavailable.
     */
    public function failed(?Throwable $exception): void
    {
        logger()->error("Failed to generate AI recommendation for Ticket #{$this->ticket->id}", [
            'exception' => $exception?->getMessage(),
        ]);

        try {
            $this->ticket->update([
                'ai_processed_at' => now(),
                'ai_recommendation_reason' => 'Could not obtain an automatic recommendation at this time.',
            ]);
        } catch (Throwable $e) {
            Log::warning("Could not log AI failure on Ticket #{$this->ticket->id}.", [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
