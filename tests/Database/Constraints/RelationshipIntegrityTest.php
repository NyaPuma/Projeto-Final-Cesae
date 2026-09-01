<?php

namespace Tests\Database\Constraints;

use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Notification;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationshipIntegrityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA', 'description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['code' => 'EM_CURSO', 'description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['code' => 'FECHADA', 'description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['code' => 'CANCELADA', 'description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['code' => 'PENDENTE_ORCAMENTO', 'description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['code' => 'RECUSADA', 'description' => 'Recusada']);
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
    // SECTION 2: FOREIGN KEY INTEGRITY
    // ==========================================

    public function test_ticket_references_valid_user(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'FK User Test',
            'description' => 'Testing user FK',
            'priority' => 'baixa',
        ]);
        $response->assertStatus(201);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $this->assertNotNull($ticket->user);
        $this->assertEquals($user->id, $ticket->user_id);
    }

    public function test_ticket_references_valid_status(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'FK Status Test',
            'description' => 'Testing status FK',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $this->assertNotNull($ticket->status);
        $this->assertEquals('aberta', $ticket->status->name);
    }

    public function test_ticket_comment_references_valid_ticket_and_user(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Comment FK Test',
            'description' => 'Testing comment FKs',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $this->asUserWithToken($technician);
        $response = $this->postJson("/tickets/{$ticketId}/comments", [
            'comment' => 'FK integrity test comment',
        ]);
        $response->assertStatus(201);
        $commentId = $response->json('comment.id');

        $comment = TicketComment::find($commentId);
        $this->assertNotNull($comment->ticket);
        $this->assertNotNull($comment->user);
        $this->assertEquals($ticketId, $comment->ticket_id);
        $this->assertEquals($technician->id, $comment->user_id);
    }

    public function test_equipment_references_valid_room_and_category(): void
    {
        $room = Room::create(['name' => 'FK Room', 'code' => 'RM-'.uniqid(), 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'FK Cat', 'active' => true]);

        $equipment = Equipment::create([
            'name' => 'FK Equipment',
            'serial' => 'FK-'.uniqid(),
            'room_id' => $room->id,
            'category_id' => $category->id,
            'active' => true,
        ]);

        $this->assertNotNull($equipment->room);
        $this->assertNotNull($equipment->category);
        $this->assertEquals($room->id, $equipment->room_id);
        $this->assertEquals($category->id, $equipment->category_id);
    }

    public function test_notification_references_valid_user(): void
    {
        $user = $this->createCommonUser();

        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => 'FK Notification Test',
            'message' => 'Test',
            'type' => 'system',
        ]);

        $this->assertNotNull($notification->user);
        $this->assertEquals($user->id, $notification->user_id);
    }

    // ==========================================
    // SECTION 5: RELATIONSHIP INTEGRITY
    // ==========================================

    public function test_user_has_many_tickets(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        for ($i = 0; $i < 3; $i++) {
            $this->postJson('/tickets', [
                'title' => "Multi Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
            ]);
        }

        $this->assertEquals(3, $user->tickets()->count());
    }

    public function test_ticket_has_many_comments(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Comment Rel Test',
            'description' => 'Test',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $this->asUserWithToken($technician);
        $this->postJson("/tickets/{$ticketId}/comments", ['comment' => 'First']);
        $this->postJson("/tickets/{$ticketId}/comments", ['comment' => 'Second']);

        $ticket = Ticket::find($ticketId);
        $this->assertEquals(2, $ticket->comments()->count());
    }

    public function test_ticket_belongs_to_status(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Status Rel Test',
            'description' => 'Test',
            'priority' => 'média',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::with('status')->find($ticketId);
        $this->assertNotNull($ticket->status);
        $this->assertEquals('aberta', $ticket->status->name);
    }

    public function test_ticket_belongs_to_equipment_and_room(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $room = Room::create(['name' => 'Rel Room', 'code' => 'RM-'.uniqid(), 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Rel Cat', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Rel Equipment',
            'serial' => 'REL-'.uniqid(),
            'room_id' => $room->id,
            'category_id' => $category->id,
            'active' => true,
        ]);

        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Equipment Rel Test',
            'description' => 'Test',
            'priority' => 'alta',
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::with(['equipment', 'room'])->find($ticketId);
        $this->assertEquals($equipment->id, $ticket->equipment_id);
        $this->assertEquals($room->id, $ticket->room_id);
        $this->assertNotNull($ticket->equipment);
        $this->assertNotNull($ticket->room);
    }

    public function test_user_profile_relationship(): void
    {
        $admin = $this->createAdmin();
        $admin->load('profile');

        $this->assertNotNull($admin->profile);
        $this->assertEquals(UserRoleEnum::Admin->value, $admin->profile->name);
    }

    public function test_user_is_admin_check(): void
    {
        $admin = $this->createAdmin();
        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isTechnician());
        $this->assertFalse($admin->isCommonUser());
    }

    public function test_user_is_technician_check(): void
    {
        $technician = $this->createTechnician();
        $this->assertTrue($technician->isTechnician());
        $this->assertFalse($technician->isAdmin());
        $this->assertFalse($technician->isCommonUser());
    }

    public function test_equipment_belongs_to_category_relationship(): void
    {
        $category = EquipmentCategory::create(['name' => 'Rel Test Cat', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Rel Cat Equipment',
            'serial' => 'RCAT-'.uniqid(),
            'category_id' => $category->id,
            'active' => true,
        ]);

        $equipment->load('category');
        $this->assertNotNull($equipment->category);
        $this->assertEquals($category->id, $equipment->category_id);
    }

    // ==========================================
    // SECTION 12: EQUIPMENT CATEGORY RELATIONSHIP INTEGRITY
    // ==========================================

    public function test_equipment_category_has_many_equipments(): void
    {
        $category = EquipmentCategory::create(['name' => 'HasMany Cat', 'active' => true]);

        for ($i = 0; $i < 3; $i++) {
            Equipment::create([
                'name' => "Cat Equipment {$i}",
                'serial' => 'HM-CAT-'.uniqid("-{$i}"),
                'category_id' => $category->id,
                'active' => true,
            ]);
        }

        $this->assertEquals(3, $category->equipments()->count());
    }

    public function test_room_has_many_equipments(): void
    {
        $room = Room::create(['name' => 'HasMany Room', 'code' => 'RM-'.uniqid(), 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Room Eq Cat', 'active' => true]);

        for ($i = 0; $i < 2; $i++) {
            Equipment::create([
                'name' => "Room Equipment {$i}",
                'serial' => 'HM-ROOM-'.uniqid("-{$i}"),
                'room_id' => $room->id,
                'category_id' => $category->id,
                'active' => true,
            ]);
        }

        $this->assertEquals(2, $room->equipments()->count());
    }

    public function test_room_has_many_tickets(): void
    {
        $room = Room::create(['name' => 'Ticket Room', 'code' => 'RM-'.uniqid(), 'active' => true]);
        $user = $this->createCommonUser();

        $openStatus = TicketStatus::where('name', 'aberta')->first();

        for ($i = 0; $i < 2; $i++) {
            Ticket::create([
                'title' => "Room Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
                'user_id' => $user->id,
                'room_id' => $room->id,
                'status_id' => $openStatus->id,
                'opened_at' => now(),
            ]);
        }

        $this->assertEquals(2, $room->tickets()->count());
    }

    // ==========================================
    // SECTION 13: USER DEFAULT PROFILE ASSIGNMENT
    // ==========================================

    public function test_user_gets_default_profile_on_create_without_profile(): void
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);

        $user = User::create([
            'name' => 'No Profile User',
            'email' => 'noprofile.'.uniqid().'@example.invalid',
            'password' => bcrypt('password'),
        ]);

        $this->assertNotNull($user->profile_id);
        $this->assertEquals(UserRoleEnum::User->value, $user->profile->name);
    }

    // ==========================================
    // SECTION 18: EAGER LOADING VERIFICATION
    // ==========================================

    public function test_ticket_show_eager_loads_all_relationships(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $room = Room::create(['name' => 'Eager Room', 'code' => 'RM-'.uniqid(), 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Eager Cat', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Eager Equipment',
            'serial' => 'EAGER-'.uniqid(),
            'room_id' => $room->id,
            'category_id' => $category->id,
            'active' => true,
        ]);

        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Eager Loading Test',
            'description' => 'Test eager',
            'priority' => 'alta',
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
        ]);
        $ticketId = $response->json('ticket.id');

        $this->asUserWithToken($admin);
        $response = $this->getJson("/tickets/{$ticketId}");
        $response->assertOk();

        $ticketData = $response->json('ticket');
        $this->assertArrayHasKey('equipment', $ticketData);
        $this->assertArrayHasKey('room', $ticketData);
        $this->assertArrayHasKey('user', $ticketData);
        $this->assertArrayHasKey('status', $ticketData);
    }
}
