<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketCommentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_OPEN, 'description' => 'Aberto', 'type_id' => $typeId]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function it_creates_comment_with_valid_data(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'Comment Test Ticket',
            'description' => 'Ticket for comments',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'comment' => 'This is a test comment',
        ]);

        $this->assertNotNull($comment->id);
        $this->assertEquals('This is a test comment', $comment->comment);
        $this->assertEquals($ticket->id, $comment->ticket_id);
        $this->assertEquals($user->id, $comment->user_id);
    }

    #[Test]
    public function it_belongs_to_a_ticket(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'Relation Ticket',
            'description' => 'Testing relations',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'comment' => 'Relation check',
        ]);

        $this->assertInstanceOf(Ticket::class, $comment->ticket);
        $this->assertEquals($ticket->id, $comment->ticket->id);
    }

    #[Test]
    public function it_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'User Relation',
            'description' => 'Testing user relation',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'comment' => 'User relation check',
        ]);

        $this->assertInstanceOf(User::class, $comment->user);
        $this->assertEquals($user->id, $comment->user->id);
    }

    #[Test]
    public function it_has_fillable_attributes(): void
    {
        $comment = new TicketComment;
        $fillable = $comment->getFillable();

        $this->assertContains('ticket_id', $fillable);
        $this->assertContains('user_id', $fillable);
        $this->assertContains('comment', $fillable);
    }

    #[Test]
    public function it_can_create_multiple_comments_per_ticket(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'Multiple Comments',
            'description' => 'Testing multiple comments',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'comment' => 'First comment',
        ]);

        TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'comment' => 'Second comment',
        ]);

        $this->assertCount(2, $ticket->comments);
    }
}
