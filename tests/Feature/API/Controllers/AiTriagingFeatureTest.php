<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\AIService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Chat\CreateResponse;
use Tests\TestCase;

class AiTriagingFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_ai_service_recommends_technician_within_sla_time_limit()
    {
        $techProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        $technician = User::factory()->create(['profile_id' => $techProfile->id, 'active' => true]);
        $ticket = Ticket::factory()->create(['description' => 'Fuga de Ã³leo no motor hidrÃ¡ulico']);

        OpenAI::fake([
            CreateResponse::fake([
                'choices' => [
                    [
                        'message' => [
                            'content' => json_encode([
                                'tecnico_id' => $technician->id,
                                'justificacao' => 'Recomendado por ter menor carga e especialidade tÃ©cnica.',
                            ]),
                        ],
                    ],
                ],
            ]),
        ]);

        $startTime = microtime(true);
        $service = app(AIService::class);
        $recommendation = $service->recomendarTecnico($ticket);
        $elapsed = microtime(true) - $startTime;

        $this->assertEquals($technician->id, $recommendation['tecnico_id']);
        $this->assertStringContainsString('Recomendado por ter menor carga', $recommendation['justificacao']);
        // Verify response time SLA (RNF04: < 2 seconds)
        $this->assertLessThan(2.0, $elapsed);
    }

    public function test_ai_service_fallback_when_openai_fails()
    {
        $techProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        $technician = User::factory()->create(['profile_id' => $techProfile->id, 'active' => true]);
        $ticket = Ticket::factory()->create();

        OpenAI::fake([
            new \Exception('API Error'),
        ]);

        $service = app(AIService::class);
        $recommendation = $service->recomendarTecnico($ticket);

        $this->assertNull($recommendation['tecnico_id']);
        $this->assertStringContainsString('Assistente de IA indisponÃ­vel', $recommendation['justificacao']);
    }
}
