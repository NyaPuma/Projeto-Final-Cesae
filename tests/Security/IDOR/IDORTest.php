<?php

namespace Tests\Security\IDOR;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\ApiTestCase;

class IDORTest extends ApiTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function user_cannot_access_other_users_tickets(): void
    {
        $user1 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user1-token',
            'active' => true,
        ]);

        $user2 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user2-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user2->id]);

        $response = $this->withApiUser('user1-token')
            ->getJson("/tickets/{$ticket->id}");

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_modify_other_users_tickets(): void
    {
        $user1 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user1-token',
            'active' => true,
        ]);

        $user2 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user2-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user2->id]);

        $response = $this->withApiUser('user1-token')
            ->putJson("/tickets/{$ticket->id}", [
                'title' => 'Modified Title',
            ]);

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_delete_other_users_tickets(): void
    {
        $user1 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user1-token',
            'active' => true,
        ]);

        $user2 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user2-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user2->id]);

        $response = $this->withApiUser('user1-token')
            ->deleteJson("/tickets/{$ticket->id}");

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_access_other_users_comments(): void
    {
        $user1 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user1-token',
            'active' => true,
        ]);

        $user2 = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user2-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user2->id]);
        $comment = \App\Models\TicketComment::factory()->create([
            'ticket_id' => $ticket->id,
            'user_id' => $user2->id,
        ]);

        $response = $this->withApiUser('user1-token')
            ->getJson("/tickets/{$ticket->id}/comments/{$comment->id}");

        $response->assertForbidden();
    }

    #[Test]
    public function technician_can_access_assigned_tickets(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $technician = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'user_id' => $user->id,
            'assigned_to' => $technician->id,
        ]);

        $response = $this->withApiUser('tech-token')
            ->getJson("/tickets/{$ticket->id}");

        $response->assertOk();
    }

    #[Test]
    public function admin_can_access_all_tickets(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $admin = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id,
            'api_token' => 'admin-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('admin-token')
            ->getJson("/tickets/{$ticket->id}");

        $response->assertOk();
    }
}
