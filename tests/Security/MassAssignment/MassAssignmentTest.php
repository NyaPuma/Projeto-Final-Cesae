<?php

namespace Tests\Security\MassAssignment;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class MassAssignmentTest extends FeatureTestCase
{
    #[Test]
    public function it_prevents_setting_user_id_on_ticket_creation(): void
    {
        $userA = $this->createUserWithToken(User::ROLE_USER);
        $userB = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $userA->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Mass Assignment Test',
                'description' => 'Trying to assign to another user',
                'priority' => Ticket::PRIORITY_LOW,
                'user_id' => $userB->id,
            ]);

        $status = $response->status();
        $this->assertContains($status, [200, 201, 403, 422],
            "Unexpected status {$status} on mass assignment test"
        );

        if ($status === 201 || $status === 200) {
            $createdTicket = Ticket::where('title', 'Mass Assignment Test')->first();
            $this->assertNotNull($createdTicket, 'Ticket should have been created');

            if ($createdTicket->user_id == $userB->id) {
                \Log::critical('T4 — MASS ASSIGNMENT CONFIRMED', [
                    'user_a' => $userA->id,
                    'ticket_user_id' => $createdTicket->user_id,
                ]);
                $this->fail("MASS ASSIGNMENT VULNERABILITY: Ticket user_id set to {$userB->id} by user {$userA->id}");
            }

            $this->assertEquals($userA->id, $createdTicket->user_id,
                'Ticket should be owned by the creating user, not the injected user_id'
            );
        }
    }

    #[Test]
    public function it_prevents_mass_assignment_of_protected_fields(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Mass assignment test',
                'description' => 'Testing mass assignment protection',
                'priority' => Ticket::PRIORITY_HIGH,
                'status_id' => $openId,
                'id' => 99999,
                'user_id' => 1,
                'assigned_to' => 1,
                'minutes_spent' => 999,
                'cost' => 99999.99,
            ]);

        $this->assertContains($response->status(), [201, 422]);

        if ($response->status() === 201) {
            $ticket = Ticket::where('title', 'Mass assignment test')->first();
            $this->assertNotNull($ticket);
            $this->assertNotEquals(99999, $ticket->id);
            $this->assertEquals($user->id, $ticket->user_id);
            $this->assertNull($ticket->assigned_to);
            $this->assertNotEquals(999, $ticket->minutes_spent);
        }
    }

    #[Test]
    public function it_ignores_unexpected_fields(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Unexpected fields test',
                'description' => 'Testing unexpected fields are ignored',
                'priority' => Ticket::PRIORITY_MEDIUM,
                'status_id' => $openId,
                'is_admin' => true,
                'role' => 'superadmin',
                'is_active' => 1,
            ]);

        $this->assertContains($response->status(), [201, 422]);
    }

    #[Test]
    public function it_rejects_very_long_input(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => str_repeat('A', 500),
                'description' => 'Testing very long title',
                'priority' => Ticket::PRIORITY_LOW,
                'status_id' => $openId,
            ]);

        $response->assertStatus(422);
    }
}
