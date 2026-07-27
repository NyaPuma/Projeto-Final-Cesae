<?php

namespace Tests\Unit\Policies;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;

class TicketPolicyTest extends DatabaseTestCase
{

    private TicketPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->policy = new TicketPolicy();
        $this->seedUserProfiles();
    }

    private function seedUserProfiles(): void
    {
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function admin_can_view_any_ticket(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);

        $this->assertTrue($this->policy->viewAny($admin));
    }

    #[Test]
    public function technician_can_view_any_ticket(): void
    {
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);

        $this->assertTrue($this->policy->viewAny($technician));
    }

    #[Test]
    public function user_can_view_any_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);

        $this->assertTrue($this->policy->viewAny($user));
    }

    #[Test]
    public function admin_can_view_ticket(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertTrue($this->policy->view($admin, $ticket));
    }

    #[Test]
    public function technician_can_view_ticket(): void
    {
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertTrue($this->policy->view($technician, $ticket));
    }

    #[Test]
    public function user_can_view_own_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($this->policy->view($user, $ticket));
    }

    #[Test]
    public function user_cannot_view_other_users_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $otherUser = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create(['user_id' => $otherUser->id]);

        $this->assertFalse($this->policy->view($user, $ticket));
    }

    #[Test]
    public function only_user_can_cancel_own_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($this->policy->cancel($user, $ticket));
    }

    #[Test]
    public function user_cannot_cancel_other_users_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $otherUser = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create(['user_id' => $otherUser->id]);

        $this->assertFalse($this->policy->cancel($user, $ticket));
    }

    #[Test]
    public function technician_cannot_cancel_ticket(): void
    {
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertFalse($this->policy->cancel($technician, $ticket));
    }

    #[Test]
    public function admin_cannot_cancel_ticket(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertFalse($this->policy->cancel($admin, $ticket));
    }

    #[Test]
    public function technician_can_start_ticket(): void
    {
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertTrue($this->policy->start($technician, $ticket));
    }

    #[Test]
    public function user_cannot_start_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertFalse($this->policy->start($user, $ticket));
    }

    #[Test]
    public function technician_can_close_ticket(): void
    {
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertTrue($this->policy->close($technician, $ticket));
    }

    #[Test]
    public function user_cannot_close_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertFalse($this->policy->close($user, $ticket));
    }

    #[Test]
    public function technician_can_reopen_ticket(): void
    {
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertTrue($this->policy->reopen($technician, $ticket));
    }

    #[Test]
    public function admin_can_reopen_ticket(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertTrue($this->policy->reopen($admin, $ticket));
    }

    #[Test]
    public function user_cannot_reopen_ticket(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertFalse($this->policy->reopen($user, $ticket));
    }

    #[Test]
    public function only_admin_can_approve_budget(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertTrue($this->policy->approveBudget($admin, $ticket));
    }

    #[Test]
    public function technician_cannot_approve_budget(): void
    {
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertFalse($this->policy->approveBudget($technician, $ticket));
    }

    #[Test]
    public function user_cannot_approve_budget(): void
    {
        $user = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);
        $ticket = Ticket::factory()->create();

        $this->assertFalse($this->policy->approveBudget($user, $ticket));
    }
}
