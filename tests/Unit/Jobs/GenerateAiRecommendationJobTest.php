<?php

namespace Tests\Unit\Jobs;

use App\Jobs\GenerateAiRecommendationJob;
use App\Services\AIService;
use App\Services\TicketStatusService;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Chat\CreateResponse;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class GenerateAiRecommendationJobTest extends FeatureTestCase
{
    use CreatesTickets;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();
    }

    #[Test]
    public function it_persists_the_ai_recommendation_on_the_ticket(): void
    {
        $technician = $this->createTechnician();
        $ticket = $this->createTicket(['description' => 'Máquina de corte parada']);

        OpenAI::fake([
            CreateResponse::fake([
                'choices' => [[
                    'index' => 0,
                    'message' => [
                        'role' => 'assistant',
                        'content' => json_encode([
                            'tecnico_id' => $technician->id,
                            'justificacao' => 'Perfil mais adequado ao tipo de avaria.',
                        ]),
                    ],
                    'finish_reason' => 'stop',
                ]],
            ]),
        ]);

        (new GenerateAiRecommendationJob($ticket))->handle(app(AIService::class));

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'recommended_technician_id' => $technician->id,
            'ai_recommendation_reason' => 'Perfil mais adequado ao tipo de avaria.',
        ]);

        $this->assertNotNull($ticket->fresh()->ai_processed_at);
    }

    #[Test]
    public function it_does_not_call_the_ai_when_there_are_no_technicians_and_marks_the_ticket(): void
    {
        $ticket = $this->createTicket(['description' => 'Sem equipa disponível']);

        OpenAI::fake();

        (new GenerateAiRecommendationJob($ticket))->handle(app(AIService::class));

        OpenAI::assertNothingSent();

        $this->assertNull($ticket->fresh()->recommended_technician_id);
        $this->assertStringContainsString(
            'não existem técnicos',
            (string) $ticket->fresh()->ai_recommendation_reason,
        );
        $this->assertNotNull($ticket->fresh()->ai_processed_at);
    }

    #[Test]
    public function it_persists_the_fallback_reason_when_the_ai_is_unavailable(): void
    {
        $this->createTechnician();
        $ticket = $this->createTicket(['description' => 'IA indisponível']);

        OpenAI::fake([
            CreateResponse::fake([
                'choices' => [[
                    'index' => 0,
                    'message' => ['role' => 'assistant', 'content' => 'resposta não JSON'],
                    'finish_reason' => 'stop',
                ]],
            ]),
        ]);

        (new GenerateAiRecommendationJob($ticket))->handle(app(AIService::class));

        $this->assertNull($ticket->fresh()->recommended_technician_id);
        $this->assertStringContainsString(
            'IA indisponível',
            (string) $ticket->fresh()->ai_recommendation_reason,
        );
        $this->assertNotNull($ticket->fresh()->ai_processed_at);
    }

    #[Test]
    public function it_is_unique_per_ticket(): void
    {
        $ticket = $this->createTicket(['description' => 'Unicidade']);

        $job = new GenerateAiRecommendationJob($ticket);

        $this->assertInstanceOf(\Illuminate\Contracts\Queue\ShouldBeUnique::class, $job);
        $this->assertEquals((string) $ticket->id, $job->uniqueId());
        $this->assertGreaterThan(0, $job->uniqueFor());
    }

    #[Test]
    public function failed_records_the_error_on_the_ticket(): void
    {
        $ticket = $this->createTicket(['description' => 'Falha do job']);

        (new GenerateAiRecommendationJob($ticket))->failed(new \RuntimeException('API fora do ar'));

        $this->assertNotNull($ticket->fresh()->ai_processed_at);
        $this->assertStringContainsString(
            'Não foi possível obter uma recomendação',
            (string) $ticket->fresh()->ai_recommendation_reason,
        );
    }
}
