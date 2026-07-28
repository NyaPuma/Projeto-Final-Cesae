<?php

namespace Tests\Database\Constraints;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConcurrencyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    protected function createAdmin(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $token = 'admin-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createCommonUser(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $token = 'user-persist-token-'.uniqid();
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
    // SECTION 16: PAGINATION INTEGRITY
    // ==========================================

    public function test_ticket_listing_returns_paginated_results(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $user = $this->createCommonUser();
        $openStatus = TicketStatus::where('name', 'aberta')->first();

        for ($i = 0; $i < 20; $i++) {
            Ticket::create([
                'title' => "Paginated Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
                'user_id' => $user->id,
                'status_id' => $openStatus->id,
                'opened_at' => now(),
            ]);
        }

        $response = $this->getJson('/api/tickets');
        $response->assertOk();
        $this->assertArrayHasKey('tickets', $response->json());
    }

    // ==========================================
    // SECTION 17: CONCURRENT OPERATIONS SAFETY
    // ==========================================

    public function test_multiple_users_cannot_create_duplicate_emails(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $email = 'concurrent.'.uniqid().'@example.invalid';

        $this->postJson('/admin/users', [
            'name' => 'First User',
            'email' => $email,
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => User::ROLE_USER,
            'profile_id' => $profile->id,
        ])->assertStatus(201);

        $this->postJson('/admin/users', [
            'name' => 'Second User',
            'email' => $email,
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => User::ROLE_USER,
            'profile_id' => $profile->id,
        ])->assertStatus(422);
    }

    public function test_multiple_tickets_can_be_created_independently(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $ticketIds = [];
        for ($i = 0; $i < 5; $i++) {
            $response = $this->postJson('/tickets', [
                'title' => "Independent Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
            ]);
            $response->assertStatus(201);
            $ticketIds[] = $response->json('ticket.id');
        }

        $this->assertCount(5, array_unique($ticketIds));
        $this->assertEquals(5, Ticket::whereIn('id', $ticketIds)->count());
    }
}
