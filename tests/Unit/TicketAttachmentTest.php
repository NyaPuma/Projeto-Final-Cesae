<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketAttachmentTest extends TestCase
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
    public function it_creates_attachment_with_valid_data(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'Attachment Test',
            'description' => 'Testing attachments',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'photo.jpg',
            'path' => 'uploads/tickets/photo.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024000,
        ]);

        $this->assertNotNull($attachment->id);
        $this->assertEquals('photo.jpg', $attachment->file_name);
        $this->assertEquals('uploads/tickets/photo.jpg', $attachment->path);
        $this->assertEquals('image/jpeg', $attachment->mime_type);
        $this->assertEquals(1024000, $attachment->size);
    }

    #[Test]
    public function it_belongs_to_a_ticket(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'Attachment Relation',
            'description' => 'Testing attachment relation',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'doc.pdf',
            'path' => 'uploads/tickets/doc.pdf',
            'mime_type' => 'application/pdf',
            'size' => 500000,
        ]);

        $this->assertInstanceOf(Ticket::class, $attachment->ticket);
        $this->assertEquals($ticket->id, $attachment->ticket->id);
    }

    #[Test]
    public function it_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'User Attachment Relation',
            'description' => 'Testing user relation on attachment',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'report.xlsx',
            'path' => 'uploads/tickets/report.xlsx',
            'mime_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'size' => 250000,
        ]);

        $this->assertInstanceOf(User::class, $attachment->user);
        $this->assertEquals($user->id, $attachment->user->id);
    }

    #[Test]
    public function it_has_fillable_attributes(): void
    {
        $attachment = new TicketAttachment;
        $fillable = $attachment->getFillable();

        $this->assertContains('ticket_id', $fillable);
        $this->assertContains('user_id', $fillable);
        $this->assertContains('file_name', $fillable);
        $this->assertContains('path', $fillable);
        $this->assertContains('mime_type', $fillable);
        $this->assertContains('size', $fillable);
    }

    #[Test]
    public function it_handles_multiple_attachments_per_ticket(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'title' => 'Multiple Attachments',
            'description' => 'Testing multiple attachments',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'img1.png',
            'path' => 'uploads/tickets/img1.png',
            'mime_type' => 'image/png',
            'size' => 800000,
        ]);

        TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'img2.png',
            'path' => 'uploads/tickets/img2.png',
            'mime_type' => 'image/png',
            'size' => 1200000,
        ]);

        $this->assertCount(2, $ticket->attachments);
    }
}
