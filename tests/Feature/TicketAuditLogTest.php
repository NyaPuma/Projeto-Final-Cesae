<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketAuditLogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        \App\Models\UserProfile::create(['name' => User::ROLE_USER]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    public function test_ticket_updates_create_an_audit_entry(): void
    {
        $userProfile = \App\Models\UserProfile::where('name', User::ROLE_USER)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Initial title',
            'description' => 'Initial description',
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $ticket->title = 'Updated title';
        $ticket->save();

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Ticket::class,
            'auditable_id' => $ticket->id,
            'event' => 'updated',
        ]);
    }
}
