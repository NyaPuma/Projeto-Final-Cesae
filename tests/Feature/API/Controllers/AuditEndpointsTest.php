<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Userprofile as UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuditEndpointsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    public function test_admin_can_access_audit_endpoints_and_audits_are_paginated(): void
    {
        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->firstOrFail();
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();

        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);
        $creator = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $room = Room::create(['name' => 'Audit Room', 'location' => 'Floor 4', 'active' => true]);
        Equipment::create(['name' => 'Audit Laptop', 'serial' => 'AUD-123', 'room_id' => $room->id, 'active' => true]);
        Ticket::create([
            'user_id' => $creator->id,
            'title' => 'Audit ticket',
            'description' => 'Generate audit log',
            'status_id' => app(TicketStatusService::class)->getByName(TicketStatusEnum::Open),
            'opened_at' => now(),
        ]);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/admin/audits')
            ->assertOk()
            ->assertJsonStructure(['audits']);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->get('/ui/audits')
            ->assertOk();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/ui/analytics')
            ->assertOk();

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Ticket::class,
            'event' => 'created',
        ]);
    }

    public function test_admin_audit_endpoint_returns_empty_payload_when_no_history_exists(): void
    {
        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->firstOrFail();
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/admin/audits')
            ->assertOk()
            ->assertJsonStructure(['audits'])
            ->assertJsonPath('audits.data', []);
    }

    public function test_admin_audit_endpoint_is_forbidden_for_common_user(): void
    {
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/admin/audits')
            ->assertStatus(403);
    }
}
