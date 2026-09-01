<?php

namespace Tests\Feature;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CommentOperationFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
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
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Technician comment test',
            'description' => 'Testing technician commenting',
            'priority' => TicketPriorityEnum::High->value,
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
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Comment validation test',
            'description' => 'Testing comment validation',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/comments", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['comment']);
    }

    public function test_comment_with_only_whitespace_is_rejected(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Whitespace comment test',
            'description' => 'Testing whitespace comment validation',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/comments", [
                'comment' => '    ',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['comment']);
    }

    public function test_comment_text_is_trimmed(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Trim comment test',
            'description' => 'Testing comment trimming',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/comments", [
                'comment' => '   Part out received.   ',
            ]);

        $response->assertCreated();

        $this->assertDatabaseHas('ticket_comments', [
            'ticket_id' => $ticket->id,
            'comment' => 'Part out received.',
        ]);
    }

    public function test_list_comments_returns_all_comments(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Comment listing test',
            'description' => 'Testing comment listing',
            'priority' => TicketPriorityEnum::Low->value,
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
                '*' => ['id', 'ticket_id', 'user_id', 'comment', 'user'],
            ]]);
        $this->assertCount(2, $response->json('comments'));
        $this->assertSame('First comment: Inspecting the issue.', $response->json('comments.0.comment'));
        $this->assertSame('Second comment: Found the problem.', $response->json('comments.1.comment'));
        $this->assertSame($technician->name, $response->json('comments.0.user.name'));
    }

    public function test_comment_min_and_max_length_validation(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Comment length test',
            'description' => 'Testing comment length validation',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $send = fn (string $comment) => $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/comments", ['comment' => $comment]);

        // Comment with fewer than 3 characters
        $send('ab')->assertStatus(422)->assertJsonValidationErrors(['comment']);

        // Comment above 2000 characters
        $send(str_repeat('a', 2001))->assertStatus(422)->assertJsonValidationErrors(['comment']);

        // Exactly 2000 characters is accepted
        $send(str_repeat('a', 2000))->assertCreated();
    }
}
