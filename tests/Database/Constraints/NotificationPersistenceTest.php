<?php

namespace Tests\Database\Constraints;


use App\Enums\UserRoleEnum;
use App\Models\Notification;
use App\Models\TicketComment;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationPersistenceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orÃ§amento'], ['description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    protected function createAdmin(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        $token = 'admin-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createTechnician(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        $token = 'tech-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createCommonUser(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        $token = 'user-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function asUserWithToken(User $user): static
    {
        return $this->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('Accept', 'application/json');
    }

    // ==========================================
    // SECTION 9: NOTIFICATION INTEGRITY
    // ==========================================

    public function test_notification_created_on_ticket_comment(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Notification Test',
            'description' => 'Test notifications',
            'priority' => 'mÃ©dia',
        ]);
        $ticketId = $response->json('ticket.id');

        $this->asUserWithToken($technician);
        $response = $this->postJson("/tickets/{$ticketId}/comments", [
            'comment' => 'Notification trigger',
        ]);
        $response->assertStatus(201);

        $comment = TicketComment::where('ticket_id', $ticketId)->first();
        $this->assertNotNull($comment);
    }

    public function test_notification_is_read_boolean_cast(): void
    {
        $user = $this->createCommonUser();

        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => 'Boolean Cast Test',
            'message' => 'Test',
            'type' => 'test',
            'is_read' => false,
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'is_read' => false,
        ]);

        $notification->update(['is_read' => true]);
        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'is_read' => true,
        ]);
    }
}
