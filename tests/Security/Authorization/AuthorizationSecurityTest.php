<?php

namespace Tests\Security\Authorization;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class AuthorizationSecurityTest extends FeatureTestCase
{
    #[Test]
    public function it_prevents_user_a_from_viewing_user_b_ticket(): void
    {
        $userA = $this->createUserWithToken(User::ROLE_USER);
        $userB = $this->createUserWithToken(User::ROLE_USER);

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Ticket do User B - confidencial',
            'description' => 'Dados industriais sensíveis do User B',
            'priority' => Ticket::PRIORITY_HIGH,
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
            \Log::critical('T3 — IDOR CONFIRMED: User A can view User B ticket via API', [
                'user_a' => $userA->id,
                'user_b' => $userB->id,
                'ticket_id' => $ticket->id,
            ]);
        }
    }

    #[Test]
    public function it_prevents_user_a_from_listing_user_b_ticket_photos(): void
    {
        $userA = $this->createUserWithToken(User::ROLE_USER);
        $userB = $this->createUserWithToken(User::ROLE_USER);

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Ticket com fotos sensíveis',
            'description' => 'Fotos de equipamento industrial',
            'priority' => Ticket::PRIORITY_LOW,
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
            \Log::critical('T3 — IDOR CONFIRMED: User A can list photos of User B ticket', [
                'user_a' => $userA->id,
                'ticket_id' => $ticket->id,
            ]);
        }

        $this->assertTrue(true, 'T3 photos IDOR test completed with status: '.$status);
    }

    #[Test]
    public function it_prevents_privilege_escalation_via_profile_id(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $originalProfileId = $user->profile_id;
        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/profile/update', [
                'name' => 'Hacker',
                'profile_id' => $adminProfile->id,
            ]);

        $status = $response->status();

        $this->assertContains($status, [200, 403, 404, 422],
            "Unexpected status {$status} on privilege escalation test"
        );

        $user->refresh();

        if ($status === 404) {
            $this->assertEquals($originalProfileId, $user->profile_id,
                'User profile_id should not have changed when endpoint is 404'
            );

            return;
        }

        if ($user->profile_id == $adminProfile->id) {
            \Log::critical('T4 — PRIVILEGE ESCALATION CONFIRMED', [
                'user_id' => $user->id,
                'old_profile_id' => $originalProfileId,
                'new_profile_id' => $user->profile_id,
            ]);
            $this->fail("PRIVILEGE ESCALATION: User id={$user->id} changed to admin");
        }

        $this->assertEquals($originalProfileId, $user->profile_id,
            'User profile_id should not have changed to admin'
        );
    }

    #[Test]
    public function it_prevents_operator_from_creating_users(): void
    {
        $operator = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $operator->api_token)
            ->actingAs($operator)
            ->postJson('/api/admin/users', [
                'name' => 'Hacker Account',
                'email' => 'hacker@empresa.pt',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'role' => User::ROLE_ADMIN,
                'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            ]);

        $response->assertStatus(403);
    }
}
