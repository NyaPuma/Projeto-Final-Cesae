<?php

namespace Tests\Security\PrivilegeEscalation;


use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class PrivilegeEscalationTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function user_cannot_create_admin_account(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->first();

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
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->first();

        $response = $this->withApiUser('user-token')
            ->patchJson('/api/admin/users/'.$user->id, [
                'profile_id' => $adminProfile->id,
            ]);

        $response->assertForbidden();
    }

    #[Test]
    public function technician_cannot_promote_to_admin(): void
    {
        $technician = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Technician->value)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->first();

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
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
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
            'profile_id' => UserProfile::where('name', UserRoleEnum::Technician->value)->first()->id,
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
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => 'pending',
        ]);

        $response = $this->withApiUser('user-token')
            ->patchJson('/api/admin/tickets/'.$ticket->id.'/approve-budget');

        $response->assertForbidden();
    }

    #[Test]
    public function technician_cannot_approve_budget(): void
    {
        $technician = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Technician->value)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => 'pending',
        ]);

        $response = $this->withApiUser('tech-token')
            ->patchJson('/api/admin/tickets/'.$ticket->id.'/approve-budget');

        $response->assertForbidden();
    }

    #[Test]
    public function admin_can_approve_budget(): void
    {
        $admin = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id,
            'api_token' => 'admin-token',
            'active' => true,
        ]);

        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => 'pending',
        ]);

        $response = $this->withApiUser('admin-token')
            ->patchJson('/api/admin/tickets/'.$ticket->id.'/approve-budget', [
                'decision' => 'approve',
            ]);

        $response->assertOk();
    }
}
