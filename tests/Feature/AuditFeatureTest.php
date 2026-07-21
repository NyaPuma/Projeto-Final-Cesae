<?php

namespace Tests\Feature;

use App\Models\Audit;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuditFeatureTest extends TestCase
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

    public function test_admin_can_list_audits(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/admin/audits');

        $response->assertOk();
    }

    public function test_audit_created_when_ticket_is_created(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Audit creation test',
            'description' => 'Testing audit on ticket creation',
            'priority' => Ticket::PRIORITY_MEDIUM,
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
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Audit update test',
            'description' => 'Testing audit on update',
            'priority' => Ticket::PRIORITY_LOW,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $ticket->update(['priority' => Ticket::PRIORITY_HIGH]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'updated')
            ->first();

        $this->assertNotNull($audit);
        $this->assertEquals('updated', $audit->event);
        $this->assertEquals(Ticket::PRIORITY_LOW, $audit->old_values['priority']);
        $this->assertEquals(Ticket::PRIORITY_HIGH, $audit->new_values['priority']);
    }

    public function test_audit_has_correct_structure(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Audit structure test',
            'description' => 'Testing audit structure',
            'priority' => Ticket::PRIORITY_HIGH,
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
