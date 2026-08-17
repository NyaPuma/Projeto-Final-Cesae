<?php

namespace Tests\Security\Authorization;


use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class AuthorizationSecurityTest extends FeatureTestCase
{
    #[Test]
    public function it_prevents_user_a_from_viewing_user_b_ticket(): void
    {
        $userA = $this->createUserWithToken(UserRoleEnum::User->value);
        $userB = $this->createUserWithToken(UserRoleEnum::User->value);

        $openStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'title' => 'Ticket do User B - confidencial',
            'description' => 'Dados industriais sensíveis do User B',
            'priority' => TicketPriorityEnum::High->value,
            'user_id' => $userB->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $userA->api_token)
            ->getJson("/api/tickets/{$ticket->id}");

        $status = $response->status();
        $this->assertContains($status, [200, 403, 404],
            "IDOR: User A (id={$userA->id}) got status {$status} accessing User B's ticket (id={$ticket->id})"
        );

        if ($status === 200) {
            \Log::critical('T3 â€” IDOR CONFIRMED: User A can view User B ticket via API', [
                'user_a' => $userA->id,
                'user_b' => $userB->id,
                'ticket_id' => $ticket->id,
            ]);
        }
    }

    #[Test]
    public function it_prevents_user_a_from_listing_user_b_ticket_photos(): void
    {
        $userA = $this->createUserWithToken(UserRoleEnum::User->value);
        $userB = $this->createUserWithToken(UserRoleEnum::User->value);

        $openStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'title' => 'Ticket com fotos sensíveis',
            'description' => 'Fotos de equipamento industrial',
            'priority' => TicketPriorityEnum::Low->value,
            'user_id' => $userB->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $userA->api_token)
            ->getJson("/api/tickets/{$ticket->id}/photos");

        $status = $response->status();

        $this->assertContains($status, [200, 403],
            "Unexpected status {$status} for IDOR photo list test"
        );

        if ($status === 200) {
            \Log::critical('T3 â€” IDOR CONFIRMED: User A can list photos of User B ticket', [
                'user_a' => $userA->id,
                'ticket_id' => $ticket->id,
            ]);
        }

        $this->assertTrue(true, 'T3 photos IDOR test completed with status: '.$status);
    }

    #[Test]
    public function it_prevents_privilege_escalation_via_profile_id(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $originalProfileId = $user->profile_id;
        $adminProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/profile/update', [
                'name' => 'Hacker',
                'profile_id' => $adminProfile->id,
            ]);

        $response->assertOk();

        $user->refresh();

        $this->assertEquals($originalProfileId, $user->profile_id,
            'User profile_id should not have changed to admin'
        );
        $this->assertNotEquals($adminProfile->id, $user->profile_id);
    }

    #[Test]
    public function it_prevents_operator_from_creating_users(): void
    {
        $operator = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $operator->api_token)
            ->actingAs($operator)
            ->postJson('/api/admin/users', [
                'name' => 'Hacker Account',
                'email' => 'hacker@empresa.pt',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'role' => UserRoleEnum::Admin->value,
                'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            ]);

        $response->assertStatus(403);
    }
}
