<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Notifications\TicketStatusChanged;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class NotificationFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
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

    public function test_notification_sent_when_ticket_status_changes(): void
    {
        Notification::fake();

        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Notification test ticket',
            'description' => 'Testing status change notification',
            'priority' => Ticket::PRIORITY_HIGH,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        $oldStatus = $ticket->status_id;
        $ticket->update([
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now(),
        ]);

        $user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));

        Notification::assertSentTo(
            $user,
            TicketStatusChanged::class
        );
    }

    public function test_notification_sent_when_ticket_closed(): void
    {
        Notification::fake();

        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Close notification test',
            'description' => 'Testing close notification',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now()->subHours(3),
            'opened_at' => now()->subDay(),
        ]);

        $closedId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
        $oldStatus = $ticket->status_id;
        $ticket->update([
            'status_id' => $closedId,
            'closed_at' => now(),
            'minutes_spent' => 180,
            'cost' => 250.00,
        ]);

        $user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_CLOSED));

        Notification::assertSentTo(
            $user,
            TicketStatusChanged::class
        );
    }

    public function test_notification_sent_on_budget_decision(): void
    {
        Notification::fake();

        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $user = $this->createUserWithToken(User::ROLE_USER);
        $pendingId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget notification test',
            'description' => 'Testing budget decision notification',
            'priority' => Ticket::PRIORITY_HIGH,
            'status_id' => $pendingId,
            'assigned_to' => $technician->id,
            'budget_requested' => true,
            'budget_status' => Ticket::BUDGET_PENDING,
            'budget_amount' => 1200.00,
            'budget_requested_at' => now()->subDay(),
            'opened_at' => now()->subDays(2),
        ]);

        $oldStatus = $ticket->status_id;
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        $ticket->update([
            'status_id' => $inProgressId,
            'budget_status' => Ticket::BUDGET_APPROVED,
            'budget_approved_by' => $admin->id,
            'budget_decided_at' => now(),
        ]);

        $user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));

        Notification::assertSentTo(
            $user,
            TicketStatusChanged::class
        );
    }
}
