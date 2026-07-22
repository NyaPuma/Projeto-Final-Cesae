<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CommentOperationFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    private function createUserWithToken(string $profileName): User
    {
        $profile = UserProfile::where('name', $profileName)->firstOrFail();

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);
    }

    public function test_technician_can_comment_on_any_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Technician comment test',
            'description' => 'Testing technician commenting',
            'priority' => Ticket::PRIORITY_HIGH,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/comments", [
                'comment' => 'I will start the repair tomorrow morning.',
            ]);

        $response->assertCreated()
            ->assertJsonStructure(['comment' => ['id', 'ticket_id', 'user_id', 'comment']]);

        $this->assertDatabaseHas('ticket_comments', [
            'ticket_id' => $ticket->id,
            'user_id' => $technician->id,
            'comment' => 'I will start the repair tomorrow morning.',
        ]);
    }

    public function test_comment_requires_text(): void
    {
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Comment validation test',
            'description' => 'Testing comment validation',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/comments", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['comment']);
    }

    public function test_list_comments_returns_all_comments(): void
    {
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Comment listing test',
            'description' => 'Testing comment listing',
            'priority' => Ticket::PRIORITY_LOW,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $technician->id,
            'comment' => 'First comment: Inspecting the issue.',
        ]);

        TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $technician->id,
            'comment' => 'Second comment: Found the problem.',
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson("/tickets/{$ticket->id}/comments");

        $response->assertOk()
            ->assertJsonStructure(['comments' => [
                '*' => ['id', 'ticket_id', 'user_id', 'comment'],
            ]]);
        $this->assertCount(2, $response->json('comments'));
    }
}
