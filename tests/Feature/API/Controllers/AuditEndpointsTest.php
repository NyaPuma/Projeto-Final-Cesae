<?php

namespace Tests\Feature\API\Controllers;

use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Audit;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
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
            ->getJson('/api/admin/audits')
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
            ->getJson('/api/admin/audits')
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
            ->getJson('/api/admin/audits')
            ->assertStatus(403);
    }

    public function test_admin_audit_payload_includes_pagination_and_user_relation(): void
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
        Equipment::create(['name' => 'Audit Laptop', 'serial' => 'AUD-124', 'room_id' => $room->id, 'active' => true]);
        $ticket = Ticket::create([
            'user_id' => $creator->id,
            'title' => 'Audit ticket 2',
            'description' => 'Generate audit log',
            'status_id' => app(TicketStatusService::class)->getByName(TicketStatusEnum::Open),
            'opened_at' => now(),
        ]);

        Audit::create([
            'user_id' => $creator->id,
            'auditable_type' => Ticket::class,
            'auditable_id' => $ticket->id,
            'event' => 'updated',
            'old_values' => null,
            'new_values' => ['title' => 'Audit ticket 2'],
            'url' => 'http://localhost',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'phpunit',
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/admin/audits');

        $response->assertOk()
            ->assertJsonStructure([
                'audits' => [
                    'data' => [
                        [
                            'id',
                            'user_id',
                            'user' => ['id', 'name', 'email'],
                            'auditable_type',
                            'auditable_id',
                            'event',
                            'created_at',
                        ],
                    ],
                    'links',
                    'meta' => ['current_page', 'last_page', 'per_page', 'total'],
                ],
            ])
            ->assertJsonPath('audits.meta.current_page', 1)
            ->assertJsonPath('audits.meta.per_page', config('services.custom.pagination.admin_per_page'))
            ->assertJsonPath('audits.meta.total', 4)
            ->assertJsonPath('audits.data.0.user.name', $creator->name)
            ->assertJsonPath('audits.data.0.event', 'updated');

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Ticket::class,
            'event' => 'created',
        ]);
    }
}
