<?php

namespace Tests\Database\Constraints;

use App\Enums\UserRoleEnum;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TokenIntegrityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA', 'description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['code' => 'EM_CURSO', 'description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['code' => 'FECHADA', 'description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['code' => 'CANCELADA', 'description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['code' => 'PENDENTE_ORCAMENTO', 'description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['code' => 'RECUSADA', 'description' => 'Recusada']);
    }

    protected function createTechnician(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        $token = 'tech-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function asUserWithToken(User $user): static
    {
        return $this->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('Accept', 'application/json');
    }

    // ==========================================
    // SECTION 7: TOKEN HASHING INTEGRITY
    // ==========================================

    public function test_user_hash_token_produces_consistent_hash(): void
    {
        $token = 'test-token-for-hashing';
        $hash1 = User::hashToken($token);
        $hash2 = User::hashToken($token);

        $this->assertEquals($hash1, $hash2);
        $this->assertNotEquals($token, $hash1);
        $this->assertEquals(64, strlen($hash1));
    }

    public function test_different_tokens_produce_different_hashes(): void
    {
        $hash1 = User::hashToken('token-one');
        $hash2 = User::hashToken('token-two');

        $this->assertNotEquals($hash1, $hash2);
    }

    public function test_factory_users_store_plaintext_tokens_auth_works(): void
    {
        $technician = $this->createTechnician();
        $this->asUserWithToken($technician);

        $response = $this->getJson('/api/tickets');
        $response->assertOk();
    }
}
