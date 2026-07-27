<?php

namespace Tests\Security\PrivilegeEscalation;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\attributes\Test;
use Tests\Base\ApiTestCase;

class PrivilegeEscalationTest extends ApiTestCase
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
    public function user_cannot_create_admin_account(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();

        $response = $this->withApiUser('user-token')
            ->postJson('/api/admin/users', [
                'name' => 'New Admin',
                'email' => 'admin@example.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'profile_id' => $adminProfile->id,
            ]);

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_modify_their_profile_to_admin(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();

        $response = $this->withApiUser('user-token')
            ->putJson('/api/profile', [
                'profile_id' => $adminProfile->id,
            ]);

        $response->assertForbidden();
    }

    #[Test]
    public function technician_cannot_promote_to_admin(): void
    {
        $technician = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();

        $response = $this->withApiUser('tech-token')
            ->postJson('/api/admin/users', [
                'name' => 'New Admin',
                'email' => 'admin@example.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'profile_id' => $adminProfile->id,
            ]);

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_access_admin_endpoints(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $response = $this->withApiUser('user-token')
            ->getJson('/api/admin/users');

        $response->assertForbidden();
    }

    #[Test]
    public function technician_cannot_access_admin_endpoints(): void
    {
        $technician = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $response = $this->withApiUser('tech-token')
            ->getJson('/api/admin/users');

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_approve_budget(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => 'pending',
        ]);

        $response = $this->withApiUser('user-token')
            ->postJson("/tickets/{$ticket->id}/budget/approve");

        $response->assertForbidden();
    }

    #[Test]
    public function technician_cannot_approve_budget(): void
    {
        $technician = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => 'pending',
        ]);

        $response = $this->withApiUser('tech-token')
            ->postJson("/tickets/{$ticket->id}/budget/approve");

        $response->assertForbidden();
    }

    #[Test]
    public function admin_can_approve_budget(): void
    {
        $admin = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id,
            'api_token' => 'admin-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => 'pending',
        ]);

        $response = $this->withApiUser('admin-token')
            ->postJson("/tickets/{$ticket->id}/budget/approve");

        $response->assertOk();
    }
}
