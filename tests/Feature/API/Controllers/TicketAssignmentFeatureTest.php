<?php

namespace Tests\Feature\API\Controllers;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketAssignmentFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);

        app(TicketStatusService::class)->flush();
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

    private function createOpenTicket(User $user): Ticket
    {
        return Ticket::create([
            'user_id' => $user->id,
            'title' => 'Atribuição teste',
            'description' => 'Equipamento avariado',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id'),
            'opened_at' => now(),
        ]);
    }

    public function test_admin_can_assign_specific_technician(): void
    {
        $this->createUserWithToken(UserRoleEnum::User->value);
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createOpenTicket($this->createUserWithToken(UserRoleEnum::User->value));

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson("/tickets/{$ticket->id}/assign-technician", [
                'technician_id' => $technician->id,
            ]);

        $response->assertOk()
            ->assertJsonStructure(['ticket' => ['id', 'status_id', 'assigned_to', 'status']]);

        $ticket->refresh();
        $this->assertEquals($technician->id, $ticket->assigned_to);
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::InProgress));
    }

    public function test_admin_can_auto_assign_least_busy_technician(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createOpenTicket($this->createUserWithToken(UserRoleEnum::User->value));

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson("/tickets/{$ticket->id}/assign-technician");

        $response->assertOk();

        $ticket->refresh();
        $this->assertEquals($technician->id, $ticket->assigned_to);
    }

    public function test_assigning_non_technician_user_returns_422(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $this->createUserWithToken(UserRoleEnum::User->value);
        $regularUser = $this->createUserWithToken(UserRoleEnum::User->value);
        $ticket = $this->createOpenTicket($this->createUserWithToken(UserRoleEnum::User->value));

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson("/tickets/{$ticket->id}/assign-technician", [
                'technician_id' => $regularUser->id,
            ]);

        $response->assertStatus(422);

        $ticket->refresh();
        $this->assertNull($ticket->assigned_to);
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Open));
    }

    public function test_non_admin_cannot_assign_technician(): void
    {
        $this->createUserWithToken(UserRoleEnum::Admin->value);
        $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createOpenTicket($this->createUserWithToken(UserRoleEnum::User->value));

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/assign-technician", [
                'technician_id' => $technician->id,
            ]);

        $response->assertStatus(403);
    }

    public function test_cannot_assign_technician_to_closed_ticket(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);

        $closedId = TicketStatus::where('name', TicketStatusEnum::Closed->value)->value('id');
        $ticket = $this->createOpenTicket($this->createUserWithToken(UserRoleEnum::User->value));
        $ticket->update(['status_id' => $closedId]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson("/tickets/{$ticket->id}/assign-technician", [
                'technician_id' => $technician->id,
            ]);

        $response->assertStatus(422);

        $ticket->refresh();
        $this->assertNull($ticket->assigned_to);
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Closed));
    }

    public function test_assigning_non_existent_technician_returns_422(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createOpenTicket($this->createUserWithToken(UserRoleEnum::User->value));

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson("/tickets/{$ticket->id}/assign-technician", [
                'technician_id' => 99999,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['technician_id']);

        $ticket->refresh();
        $this->assertNull($ticket->assigned_to);
    }
}
