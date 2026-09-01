<?php

namespace Tests\Feature\API\Controllers;

use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketAuditLogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    public function test_ticket_updates_create_an_audit_entry(): void
    {
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

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

    public function test_admin_can_list_ticket_audit_entries(): void
    {
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->firstOrFail();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Audit case',
            'description' => 'Should be audited',
            'status_id' => TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id'),
            'opened_at' => now(),
        ]);

        $ticket->update(['title' => 'Audit case updated']);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/admin/audits');

        $response->assertOk();
        $response->assertJsonFragment([
            'auditable_type' => Ticket::class,
            'auditable_id' => $ticket->id,
        ]);
    }
}
