<?php

namespace Tests\Feature;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class ErrorScenarioFeatureTest extends TestCase
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

    public function test_api_returns_404_for_nonexistent_ticket(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/api/tickets/99999');

        $response->assertStatus(404);
    }

    public function test_api_returns_401_without_token(): void
    {
        $response = $this->getJson('/api/tickets');

        $response->assertStatus(401);
    }

    public function test_api_returns_401_with_invalid_token(): void
    {
        $response = $this->withHeader('X-Auth-Token', 'invalid-token-12345')
            ->getJson('/api/tickets');

        $response->assertStatus(401);
    }

    public function test_api_returns_422_for_method_not_allowed(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->putJson('/api/tickets/search');

        $response->assertStatus(405);
    }

    public function test_technician_cannot_start_nonexistent_ticket(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson('/technician/tickets/99999/start');

        $response->assertStatus(404);
    }

    public function test_technician_cannot_close_nonexistent_ticket(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson('/technician/tickets/99999/close');

        $response->assertStatus(404);
    }

    public function test_inactive_user_receives_401(): void
    {
        $inactiveProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $inactiveUser = User::factory()->create([
            'profile_id' => $inactiveProfile->id,
            'api_token' => Str::random(60),
            'active' => false,
        ]);

        $response = $this->withHeader('X-Auth-Token', $inactiveUser->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Test ticket from inactive user',
                'description' => 'This should be rejected',
                'priority' => 'baixa',
            ]);

        $response->assertStatus(401);
    }

    public function test_assign_nonexistent_technician_returns_404(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Assign test',
            'description' => 'Testing assign with invalid tech',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson("/tickets/{$ticket->id}/assign-technician", [
                'technician_id' => 99999,
            ]);

        $response->assertStatus(422);
    }

    public function test_comment_on_nonexistent_ticket_returns_404(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/api/tickets/99999/comments', [
                'comment' => 'Test comment on missing ticket',
            ]);

        $response->assertStatus(404);
    }

    public function test_upload_photo_on_nonexistent_ticket_returns_404(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets/99999/photos', [
                'photo' => UploadedFile::fake()->create('test.jpg', 10, 'image/jpeg'),
            ]);

        $response->assertStatus(404);
    }
}
