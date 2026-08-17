<?php

namespace Tests\Unit\Http\Resources;

use App\Enums\UserRoleEnum;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\RoomResource;
use App\Http\Resources\TicketResource;
use App\Http\Resources\UserResource;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Notification;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class ResourcesTest extends FeatureTestCase
{
    use CreatesTickets;
    public function test_ticket_resource_exposes_all_expected_keys_with_eager_relations(): void
    {
        $ticket = Ticket::with(['status', 'user', 'technician', 'equipment', 'room'])
            ->findOrFail($this->createTicket()->id);

        $payload = (new TicketResource($ticket))->resolve();

        foreach (['id', 'reference', 'title', 'description', 'priority', 'status_id', 'status', 'status_name', 'user', 'technician', 'equipment', 'room', 'budget_requested', 'minutes_spent', 'sla_breached', 'created_at'] as $key) {
            $this->assertArrayHasKey($key, $payload);
        }
        $this->assertArrayHasKey('status', $payload);
        $this->assertInstanceOf(\App\Models\TicketStatus::class, $payload['status']);
        $this->assertSame($ticket->id, $payload['id']);
    }

    public function test_ticket_resource_omits_relations_not_loaded(): void
    {
        $ticket = Ticket::findOrFail($this->createTicket()->id);

        $payload = (new TicketResource($ticket))->resolve();

        $this->assertArrayNotHasKey('technician', $payload);
        $this->assertArrayNotHasKey('equipment', $payload);
    }

    public function test_user_resource_never_leaks_api_token(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => str_repeat('x', 60),
        ]);

        $payload = (new UserResource($user->load('profile')))->resolve();

        $this->assertArrayNotHasKey('api_token', $payload);
        $this->assertSame($user->email, $payload['email']);
        $this->assertArrayHasKey('profile', $payload);
    }

    public function test_notification_and_room_resources_include_key_fields(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
        ]);
        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => 'Notificação',
            'message' => 'Mensagem',
            'type' => \App\Enums\NotificationTypeEnum::TicketCreated->value,
            'link' => '/ui/tickets/1',
        ]);
        $room = Room::withCount('equipments')->findOrFail(Room::factory()->create()->id);

        $notificationPayload = (new NotificationResource($notification))->resolve();
        $roomPayload = (new RoomResource($room))->resolve();

        $this->assertArrayHasKey('is_read', $notificationPayload);
        $this->assertArrayHasKey('title', $notificationPayload);
        $this->assertArrayHasKey('equipments_count', $roomPayload);
        $this->assertArrayHasKey('code', $roomPayload);
    }
}
