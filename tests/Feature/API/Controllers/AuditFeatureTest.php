<?php

namespace Tests\Feature;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Audit;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuditFeatureTest extends TestCase
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

    public function test_admin_can_list_audits(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/admin/audits');

        $response->assertOk();
    }

    public function test_audit_created_when_ticket_is_created(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Audit creation test',
            'description' => 'Testing audit on ticket creation',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'created')
            ->first();

        $this->assertNotNull($audit);
        $this->assertEquals('created', $audit->event);
        $this->assertArrayHasKey('title', $audit->new_values);
        $this->assertArrayHasKey('description', $audit->new_values);
    }

    public function test_audit_created_when_ticket_is_updated(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Audit update test',
            'description' => 'Testing audit on update',
            'priority' => TicketPriorityEnum::Low->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $ticket->update(['priority' => TicketPriorityEnum::High->value]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'updated')
            ->first();

        $this->assertNotNull($audit);
        $this->assertEquals('updated', $audit->event);
        $this->assertEquals(TicketPriorityEnum::Low->value, $audit->old_values['priority']);
        $this->assertEquals(TicketPriorityEnum::High->value, $audit->new_values['priority']);
    }

    public function test_audit_has_correct_structure(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Audit structure test',
            'description' => 'Testing audit structure',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $audits = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->get();

        $this->assertGreaterThanOrEqual(1, $audits->count());

        $audit = $audits->first();
        $this->assertNotNull($audit->auditable_id);
        $this->assertNotNull($audit->auditable_type);
        $this->assertNotNull($audit->event);
        $this->assertNotNull($audit->new_values);
    }
}
