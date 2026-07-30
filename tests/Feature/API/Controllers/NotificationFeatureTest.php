<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Notifications\TicketStatusChanged;
use App\Services\TicketStatusService;
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

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
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

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Notification test ticket',
            'description' => 'Testing status change notification',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $inProgressId = app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);
        $oldStatus = $ticket->status_id;
        $ticket->update([
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now(),
        ]);

        $user->notify(new TicketStatusChanged($ticket, $oldStatus, TicketStatusEnum::InProgress->value));

        Notification::assertSentTo(
            $user,
            TicketStatusChanged::class
        );
    }

    public function test_notification_sent_when_ticket_closed(): void
    {
        Notification::fake();

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $inProgressId = app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Close notification test',
            'description' => 'Testing close notification',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now()->subHours(3),
            'opened_at' => now()->subDay(),
        ]);

        $closedId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Closed);
        $oldStatus = $ticket->status_id;
        $ticket->update([
            'status_id' => $closedId,
            'closed_at' => now(),
            'minutes_spent' => 180,
            'cost' => 250.00,
        ]);

        $user->notify(new TicketStatusChanged($ticket, $oldStatus, TicketStatusEnum::Closed->value));

        Notification::assertSentTo(
            $user,
            TicketStatusChanged::class
        );
    }

    public function test_notification_sent_on_budget_decision(): void
    {
        Notification::fake();

        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $pendingId = app(TicketStatusService::class)->getByName(TicketStatusEnum::PendingBudget);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget notification test',
            'description' => 'Testing budget decision notification',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => $pendingId,
            'assigned_to' => $technician->id,
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 1200.00,
            'budget_requested_at' => now()->subDay(),
            'opened_at' => now()->subDays(2),
        ]);

        $oldStatus = $ticket->status_id;
        $inProgressId = app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);
        $ticket->update([
            'status_id' => $inProgressId,
            'budget_status' => BudgetStatusEnum::Approved->value,
            'budget_approved_by' => $admin->id,
            'budget_decided_at' => now(),
        ]);

        $user->notify(new TicketStatusChanged($ticket, $oldStatus, TicketStatusEnum::InProgress->value));

        Notification::assertSentTo(
            $user,
            TicketStatusChanged::class
        );
    }
}
