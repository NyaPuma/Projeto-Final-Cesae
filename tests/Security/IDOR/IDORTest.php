<?php

namespace Tests\Security\IDOR;

use App\Models\Ticket;
use App\Models\TicketComment;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class IDORTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function user_cannot_access_other_users_tickets(): void
    {
        $user1 = $this->createRegularUser();
        $user2 = $this->createRegularUser();
        $ticket = Ticket::factory()->create(['user_id' => $user2->id]);
        $response = $this->asApiUser($user1->api_token)
            ->getJson("/tickets/{$ticket->id}");

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_modify_other_users_tickets(): void
    {
        $user1 = $this->createRegularUser();
        $user2 = $this->createRegularUser();
        $ticket = Ticket::factory()->create(['user_id' => $user2->id]);
        $response = $this->asApiUser($user1->api_token)
            ->putJson("/tickets/{$ticket->id}", [
                'title' => 'Modified Title',
            ]);

        $response->assertStatus(405);
    }

    #[Test]
    public function user_cannot_delete_other_users_tickets(): void
    {
        $user1 = $this->createRegularUser();
        $user2 = $this->createRegularUser();
        $ticket = Ticket::factory()->create(['user_id' => $user2->id]);
        $response = $this->asApiUser($user1->api_token)
            ->deleteJson("/tickets/{$ticket->id}");

        $response->assertStatus(405);
    }

    #[Test]
    public function user_cannot_access_other_users_comments(): void
    {
        $user1 = $this->createRegularUser();
        $user2 = $this->createRegularUser();
        $ticket = Ticket::factory()->create(['user_id' => $user2->id]);
        $comment = TicketComment::factory()->create([
            'ticket_id' => $ticket->id,
            'user_id' => $user2->id,
        ]);
        $response = $this->asApiUser($user1->api_token)
            ->getJson("/tickets/{$ticket->id}/comments/{$comment->id}");

        $response->assertStatus(404);
    }

    #[Test]
    public function technician_can_access_assigned_tickets(): void
    {
        $user = $this->createRegularUser();
        $technician = $this->createTechnician();
        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'assigned_to' => $technician->id,
        ]);
        $response = $this->asApiUser($technician->api_token)
            ->getJson("/tickets/{$ticket->id}");

        $response->assertOk();
    }

    #[Test]
    public function admin_can_access_all_tickets(): void
    {
        $user = $this->createRegularUser();
        $admin = $this->createAdmin();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($admin->api_token)
            ->getJson("/tickets/{$ticket->id}");

        $response->assertOk();
    }
}
