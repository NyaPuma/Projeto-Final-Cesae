<?php

namespace Tests\Feature\API\Controllers;

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
        $ticket = Ticket::factory()->create(['description' => 'Hydraulic motor oil leak']);

        OpenAI::fake([
            CreateResponse::fake([
                'choices' => [
                    [
                        'message' => [
                            'content' => json_encode([
                                'technician_id' => $technician->id,
                                'justification' => 'Recommended due to lower workload and technical specialty.',
                            ]),
                        ],
                    ],
                ],
            ]),
        ]);

        $startTime = microtime(true);
        $service = app(AIService::class);
        $recommendation = $service->recommendTechnician($ticket);
        $elapsed = microtime(true) - $startTime;

        $this->assertEquals($technician->id, $recommendation['technician_id']);
        $this->assertStringContainsString('Recommended due to lower workload', $recommendation['justification']);
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
        $recommendation = $service->recommendTechnician($ticket);

        $this->assertNull($recommendation['technician_id']);
        $this->assertStringContainsString('AI assistant unavailable', $recommendation['justification']);
    }
}
