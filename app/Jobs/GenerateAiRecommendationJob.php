<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Services\AIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateAiRecommendationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Ticket $ticket,
    ) {}

    public function handle(AIService $aiService): array
    {
        return $aiService->recomendarTecnico($this->ticket);
    }
}
