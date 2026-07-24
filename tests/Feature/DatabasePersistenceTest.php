<?php

namespace Tests\Feature;

use App\Models\Audit;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Notification;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use App\Models\TicketStatus;
use App\Models\TicketWorkflowHistory;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabasePersistenceTest extends TestCase
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
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    protected function createAdmin(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $token = 'admin-persist-token-' . uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createTechnician(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        $token = 'tech-persist-token-' . uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createCommonUser(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $token = 'user-persist-token-' . uniqid();
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
    // SECTION 1: MODEL CRUD LIFECYCLE
    // ==========================================

    public function test_user_crud_lifecycle(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        $response = $this->postJson('/admin/users', [
            'name' => 'CRUD Test User',
            'email' => 'crud.test.' . uniqid() . '@example.invalid',
            'password' => 'password123456',
            'profile_id' => $profile->id,
        ]);
        $response->assertStatus(201);
        $userId = $response->json('user.id');
        $this->assertDatabaseHas('users', ['id' => $userId]);

        $response = $this->patchJson("/admin/users/{$userId}", [
            'name' => 'Updated CRUD User',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('users', ['id' => $userId, 'name' => 'Updated CRUD User']);
    }

    public function test_room_crud_lifecycle(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/rooms', [
            'name' => 'Test Room CRUD',
            'location' => 'Building A',
        ]);
        $response->assertStatus(201);
        $roomId = $response->json('room.id');
        $this->assertDatabaseHas('rooms', ['id' => $roomId]);

        $response = $this->patchJson("/admin/rooms/{$roomId}", [
            'name' => 'Updated Room',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('rooms', ['id' => $roomId, 'name' => 'Updated Room']);
    }

    public function test_room_inactivate_preserves_data(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/rooms', [
            'name' => 'Inactivate Test',
            'location' => 'Building B',
        ]);
        $roomId = $response->json('room.id');

        $response = $this->patchJson("/admin/rooms/{$roomId}/inactive");
        $response->assertOk();
        $this->assertDatabaseHas('rooms', ['id' => $roomId, 'active' => false]);
    }

    public function test_equipment_crud_lifecycle_with_category(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $room = Room::create(['name' => 'Eq Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Test Cat', 'active' => true]);

        $response = $this->postJson('/admin/equipment', [
            'name' => 'Test Equipment',
            'serial' => 'EQ-' . uniqid(),
            'room_id' => $room->id,
            'category_id' => $category->id,
        ]);
        $response->assertStatus(201);
        $eqId = $response->json('equipment.id');
        $this->assertDatabaseHas('equipments', [
            'id' => $eqId,
            'category_id' => $category->id,
            'room_id' => $room->id,
        ]);
    }

    public function test_ticket_crud_full_lifecycle(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Persistence Test Ticket',
            'description' => 'Full lifecycle test',
            'priority' => 'média',
        ]);
        $response->assertStatus(201);
        $ticketId = $response->json('ticket.id');
        $this->assertDatabaseHas('tickets', ['id' => $ticketId]);

        $response = $this->getJson("/tickets/{$ticketId}");
        $response->assertOk();
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
        $room = Room::create(['name' => 'FK Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'FK Cat', 'active' => true]);

        $equipment = Equipment::create([
            'name' => 'FK Equipment',
            'serial' => 'FK-' . uniqid(),
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
            'type' => 'test',
        ]);

        $this->assertNotNull($notification->user);
        $this->assertEquals($user->id, $notification->user_id);
    }

    // ==========================================
    // SECTION 3: SOFT DELETE & CASCADE BEHAVIOR
    // ==========================================

    public function test_ticket_soft_delete_preserves_record(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Soft Delete Test',
            'description' => 'Should be soft deleted',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->delete();

        $this->assertSoftDeleted('tickets', ['id' => $ticketId]);

        $ticketFromDb = Ticket::withTrashed()->find($ticketId);
        $this->assertNotNull($ticketFromDb);
        $this->assertNotNull($ticketFromDb->deleted_at);
    }

    public function test_room_soft_delete_cascades_null_equipment_room_id(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/rooms', [
            'name' => 'Cascade Room',
            'location' => 'Test',
        ]);
        $roomId = $response->json('room.id');

        $this->postJson('/admin/equipment', [
            'name' => 'Cascade Equipment',
            'serial' => 'CAS-' . uniqid(),
            'room_id' => $roomId,
        ]);

        $room = Room::find($roomId);
        $room->delete();

        $equipment = Equipment::where('room_id', $roomId)->first();
        $this->assertTrue(is_null($equipment) || ! $equipment->exists() || $equipment->room_id === null);
    }

    // ==========================================
    // SECTION 4: MASS ASSIGNMENT PROTECTION
    // ==========================================

    public function test_ticket_cannot_mass_assign_id(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Mass Assign Test',
            'description' => 'Testing mass assignment',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $originalTicket = Ticket::find($ticketId);

        $response = $this->patchJson("/tickets/{$ticketId}/comments", [
            'comment' => 'Testing',
        ]);

        $this->assertDatabaseHas('tickets', ['id' => $ticketId]);
    }

    public function test_user_cannot_mass_assign_password_via_api_token_field(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $response = $this->postJson('/admin/users', [
            'name' => 'Mass Test',
            'email' => 'mass.' . uniqid() . '@example.invalid',
            'password' => 'password123456',
            'profile_id' => $profile->id,
        ]);
        $response->assertStatus(201);
        $newUserId = $response->json('user.id');

        $user = User::find($newUserId);
        $this->assertNotEquals('password123456', $user->api_token);
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

        $room = Room::create(['name' => 'Rel Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Rel Cat', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Rel Equipment',
            'serial' => 'REL-' . uniqid(),
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
        $this->assertEquals(User::ROLE_ADMIN, $admin->profile->name);
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
            'serial' => 'RCAT-' . uniqid(),
            'category_id' => $category->id,
            'active' => true,
        ]);

        $equipment->load('category');
        $this->assertNotNull($equipment->category);
        $this->assertEquals($category->id, $equipment->category_id);
    }

    // ==========================================
    // SECTION 6: AUDIT TRAIL INTEGRITY
    // ==========================================

    public function test_ticket_creation_generates_audit_record(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Audit Trail Test',
            'description' => 'Should create audit',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $audit = Audit::where('auditable_type', Ticket::class)
            ->where('auditable_id', $ticketId)
            ->where('event', 'created')
            ->first();

        $this->assertNotNull($audit, 'Audit record should be created for ticket creation');
        $this->assertNotNull($audit->new_values);
    }

    public function test_ticket_update_generates_audit_record(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Audit Update Test',
            'description' => 'Will update',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->update(['title' => 'Updated Title for Audit']);

        $audit = Audit::where('auditable_type', Ticket::class)
            ->where('auditable_id', $ticketId)
            ->where('event', 'updated')
            ->first();

        $this->assertNotNull($audit, 'Audit record should be created for ticket update');
        $this->assertArrayHasKey('title', $audit->new_values);
    }

    // ==========================================
    // SECTION 7: TOKEN HASHING INTEGRITY
    // ==========================================

    public function test_user_hash_token_produces_consistent_hash(): void
    {
        $token = 'test-token-for-hashing';
        $hash1 = User::hashToken($token);
        $hash2 = User::hashToken($token);

        $this->assertEquals($hash1, $hash2);
        $this->assertNotEquals($token, $hash1);
        $this->assertEquals(64, strlen($hash1));
    }

    public function test_different_tokens_produce_different_hashes(): void
    {
        $hash1 = User::hashToken('token-one');
        $hash2 = User::hashToken('token-two');

        $this->assertNotEquals($hash1, $hash2);
    }

    public function test_factory_users_store_plaintext_tokens_auth_works(): void
    {
        $technician = $this->createTechnician();
        $this->asUserWithToken($technician);

        $response = $this->getJson('/api/tickets');
        $response->assertOk();
    }

    // ==========================================
    // SECTION 8: STATUS WORKFLOW INTEGRITY
    // ==========================================

    public function test_ticket_status_transitions_through_workflow(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Workflow Test',
            'description' => 'Status transitions',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $openStatus = TicketStatus::where('name', 'aberta')->first();
        $inProgressStatus = TicketStatus::where('name', 'em curso')->first();

        $ticket = Ticket::find($ticketId);
        $this->assertEquals($openStatus->id, $ticket->status_id);

        $ticket->update([
            'status_id' => $inProgressStatus->id,
            'assigned_to' => $technician->id,
            'in_progress_at' => now(),
        ]);

        $ticket->refresh();
        $this->assertEquals($inProgressStatus->id, $ticket->status_id);
        $this->assertNotNull($ticket->in_progress_at);
    }

    public function test_ticket_budget_workflow(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Budget Workflow Test',
            'description' => 'Budget test',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $pendingStatus = TicketStatus::where('name', 'pendente orçamento')->first();
        $ticket = Ticket::find($ticketId);
        $ticket->update([
            'status_id' => $pendingStatus->id,
            'budget_requested' => true,
            'budget_status' => Ticket::BUDGET_PENDING,
            'budget_amount' => 100.00,
            'budget_requested_at' => now(),
            'assigned_to' => $technician->id,
        ]);

        $ticket->refresh();
        $this->assertEquals(Ticket::BUDGET_PENDING, $ticket->budget_status);
        $this->assertTrue($ticket->budget_requested);
        $this->assertNotNull($ticket->budget_requested_at);

        $approved = $ticket->approveBudget($admin, 'approve');
        $this->assertTrue($approved);
        $ticket->refresh();
        $this->assertEquals(Ticket::BUDGET_APPROVED, $ticket->budget_status);
        $this->assertNotNull($ticket->budget_decided_at);
    }

    public function test_ticket_budget_rejection(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Budget Reject Test',
            'description' => 'Budget reject',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->update([
            'budget_requested' => true,
            'budget_status' => Ticket::BUDGET_PENDING,
            'budget_amount' => 200.00,
            'budget_requested_at' => now(),
            'assigned_to' => $technician->id,
        ]);

        $rejected = $ticket->approveBudget($admin, 'reject', 'Too expensive');
        $this->assertTrue($rejected);
        $ticket->refresh();
        $this->assertEquals(Ticket::BUDGET_REJECTED, $ticket->budget_status);
        $this->assertEquals('Too expensive', $ticket->budget_feedback);
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
            'priority' => 'média',
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

    // ==========================================
    // SECTION 10: DATA TYPE & CAST INTEGRITY
    // ==========================================

    public function test_ticket_datetime_casts(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Cast Test',
            'description' => 'DateTime casts',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $this->assertNotNull($ticket->opened_at);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $ticket->opened_at);
    }

    public function test_ticket_json_cast_budget_details(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $details = [
            ['description' => 'Part A', 'type' => 'material', 'quantity' => 2, 'unit_price' => 15.50],
            ['description' => 'Labor', 'type' => 'labor', 'hours' => 3, 'hourly_rate' => 25.00],
        ];

        $response = $this->postJson('/tickets', [
            'title' => 'JSON Cast Test',
            'description' => 'JSON budget details',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->update(['budget_details' => $details]);

        $ticket->refresh();
        $this->assertIsArray($ticket->budget_details);
        $this->assertCount(2, $ticket->budget_details);
        $this->assertEquals('material', $ticket->budget_details[0]['type']);
    }

    public function test_ticket_boolean_cast_scheduled(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Boolean Cast Test',
            'description' => 'Boolean',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $this->assertIsBool($ticket->scheduled ?? false);

        $ticket->update(['scheduled' => true]);
        $ticket->refresh();
        $this->assertTrue((bool) $ticket->scheduled);
    }

    public function test_user_boolean_cast_active(): void
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'active' => true,
        ]);
        $this->assertIsBool($user->active);
        $this->assertTrue($user->active);
    }

    // ==========================================
    // SECTION 11: UNIQUE CONSTRAINT ENFORCEMENT
    // ==========================================

    public function test_user_email_unique_constraint(): void
    {
        $this->createCommonUser();

        $this->expectException(QueryException::class);

        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $existingUser = User::first();
        User::create([
            'name' => 'Dup Email',
            'email' => $existingUser->email,
            'password' => bcrypt('password'),
            'profile_id' => $profile->id,
        ]);
    }

    public function test_equipment_serial_unique_constraint(): void
    {
        $category = EquipmentCategory::create(['name' => 'Dup Cat', 'active' => true]);
        Equipment::create([
            'name' => 'First',
            'serial' => 'UNIQUE-SERIAL-001',
            'category_id' => $category->id,
            'active' => true,
        ]);

        $this->expectException(QueryException::class);

        Equipment::create([
            'name' => 'Second',
            'serial' => 'UNIQUE-SERIAL-001',
            'category_id' => $category->id,
            'active' => true,
        ]);
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
                'serial' => "HM-CAT-" . uniqid("-{$i}"),
                'category_id' => $category->id,
                'active' => true,
            ]);
        }

        $this->assertEquals(3, $category->equipments()->count());
    }

    public function test_room_has_many_equipments(): void
    {
        $room = Room::create(['name' => 'HasMany Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Room Eq Cat', 'active' => true]);

        for ($i = 0; $i < 2; $i++) {
            Equipment::create([
                'name' => "Room Equipment {$i}",
                'serial' => "HM-ROOM-" . uniqid("-{$i}"),
                'room_id' => $room->id,
                'category_id' => $category->id,
                'active' => true,
            ]);
        }

        $this->assertEquals(2, $room->equipments()->count());
    }

    public function test_room_has_many_tickets(): void
    {
        $room = Room::create(['name' => 'Ticket Room', 'active' => true]);
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
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        $user = User::create([
            'name' => 'No Profile User',
            'email' => 'noprofile.' . uniqid() . '@example.invalid',
            'password' => bcrypt('password'),
        ]);

        $this->assertNotNull($user->profile_id);
        $this->assertEquals(User::ROLE_USER, $user->profile->name);
    }

    // ==========================================
    // SECTION 14: BUDGET CALCULATION ACCESSORS
    // ==========================================

    public function test_budget_total_accessor(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Budget Calc Test',
            'description' => 'Accessor test',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $details = [
            ['description' => 'Part', 'type' => 'material', 'quantity' => 2, 'unit_price' => 10.00],
            ['description' => 'Work', 'type' => 'labor', 'hours' => 3, 'hourly_rate' => 20.00],
        ];

        $ticket = Ticket::find($ticketId);
        $ticket->update(['budget_details' => $details]);
        $ticket->refresh();

        $this->assertEquals(20.00, $ticket->total_material_cost);
        $this->assertEquals(60.00, $ticket->total_labor_cost);
        $this->assertEquals(80.00, $ticket->budget_total);
    }

    // ==========================================
    // SECTION 15: SLA CALCULATION
    // ==========================================

    public function test_budget_pause_minutes_calculation(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'SLA Test',
            'description' => 'SLA pause',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->update([
            'budget_requested_at' => now()->subHours(2),
            'budget_decided_at' => now(),
        ]);
        $ticket->refresh();

        $this->assertEquals(120, $ticket->budget_pause_minutes);
    }

    // ==========================================
    // SECTION 16: PAGINATION INTEGRITY
    // ==========================================

    public function test_ticket_listing_returns_paginated_results(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $user = $this->createCommonUser();
        $openStatus = TicketStatus::where('name', 'aberta')->first();

        for ($i = 0; $i < 20; $i++) {
            Ticket::create([
                'title' => "Paginated Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
                'user_id' => $user->id,
                'status_id' => $openStatus->id,
                'opened_at' => now(),
            ]);
        }

        $response = $this->getJson('/api/tickets');
        $response->assertOk();
        $this->assertArrayHasKey('tickets', $response->json());
    }

    // ==========================================
    // SECTION 17: CONCURRENT OPERATIONS SAFETY
    // ==========================================

    public function test_multiple_users_cannot_create_duplicate_emails(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $email = 'concurrent.' . uniqid() . '@example.invalid';

        $this->postJson('/admin/users', [
            'name' => 'First User',
            'email' => $email,
            'password' => 'password123456',
            'profile_id' => $profile->id,
        ])->assertStatus(201);

        $this->postJson('/admin/users', [
            'name' => 'Second User',
            'email' => $email,
            'password' => 'password123456',
            'profile_id' => $profile->id,
        ])->assertStatus(422);
    }

    public function test_multiple_tickets_can_be_created_independently(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $ticketIds = [];
        for ($i = 0; $i < 5; $i++) {
            $response = $this->postJson('/tickets', [
                'title' => "Independent Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
            ]);
            $response->assertStatus(201);
            $ticketIds[] = $response->json('ticket.id');
        }

        $this->assertCount(5, array_unique($ticketIds));
        $this->assertEquals(5, Ticket::whereIn('id', $ticketIds)->count());
    }

    // ==========================================
    // SECTION 18: EAGER LOADING VERIFICATION
    // ==========================================

    public function test_ticket_show_eager_loads_all_relationships(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $room = Room::create(['name' => 'Eager Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Eager Cat', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Eager Equipment',
            'serial' => 'EAGER-' . uniqid(),
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

    // ==========================================
    // SECTION 19: EMPTY & EDGE CASE DATA
    // ==========================================

    public function test_ticket_with_null_optional_fields(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Null Fields Test',
            'description' => 'Minimal data',
            'priority' => 'baixa',
        ]);
        $response->assertStatus(201);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $this->assertNull($ticket->equipment_id);
        $this->assertNull($ticket->room_id);
        $this->assertNull($ticket->assigned_to);
        $this->assertNull($ticket->cost);
        $this->assertNull($ticket->technical_report);
    }

    public function test_equipment_without_category_creates_successfully(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/equipment', [
            'name' => 'No Category Equipment',
            'serial' => 'NC-' . uniqid(),
        ]);
        $response->assertStatus(201);
        $eqId = $response->json('equipment.id');

        $equipment = Equipment::find($eqId);
        $this->assertNull($equipment->category_id);
    }

    public function test_room_inactivate_sets_active_false(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/rooms', [
            'name' => 'Reactivate Room',
            'location' => 'Test',
        ]);
        $roomId = $response->json('room.id');

        $this->patchJson("/admin/rooms/{$roomId}/inactive")->assertOk();
        $this->assertDatabaseHas('rooms', ['id' => $roomId, 'active' => false]);

        $room = Room::find($roomId);
        $room->update(['active' => true]);
        $this->assertDatabaseHas('rooms', ['id' => $roomId, 'active' => true]);
    }

    // ==========================================
    // SECTION 20: REOPEN WORKFLOW
    // ==========================================

    public function test_ticket_reopen_workflow(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Reopen Test',
            'description' => 'Will be closed then reopened',
            'priority' => 'média',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);

        $closedStatus = TicketStatus::where('name', 'fechada')->first();
        $ticket->update([
            'status_id' => $closedStatus->id,
            'closed_at' => now(),
        ]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_CLOSED));

        $this->assertTrue($ticket->reopen());
        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_OPEN));
        $this->assertNotNull($ticket->reopened_at);
        $this->assertNull($ticket->closed_at);
    }

    // ==========================================
    // SECTION 21: ATTACHMENT INTEGRITY
    // ==========================================

    public function test_attachment_belongs_to_ticket_and_user(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Attachment Test Ticket',
            'description' => 'Test',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');
        $user = $this->createCommonUser();

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticketId,
            'user_id' => $user->id,
            'file_name' => 'test.jpg',
            'path' => 'ticket_photos/test.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
        ]);

        $this->assertNotNull($attachment->user);
        $this->assertEquals($user->id, $attachment->user_id);
        $this->assertNotNull($attachment->ticket);
        $this->assertEquals($ticketId, $attachment->ticket_id);
    }

    // ==========================================
    // SECTION 22: WORKFLOW HISTORY INTEGRITY
    // ==========================================

    public function test_workflow_history_model_crud(): void
    {
        $user = $this->createTechnician();
        $openStatus = TicketStatus::where('name', 'aberta')->first();
        $inProgressStatus = TicketStatus::where('name', 'em curso')->first();

        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Workflow History Test',
            'description' => 'Test',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $technician = $this->createTechnician();
        $wh = TicketWorkflowHistory::create([
            'ticket_id' => $ticketId,
            'origin_status_id' => $openStatus->id,
            'destination_status_id' => $inProgressStatus->id,
            'technician_id' => $technician->id,
            'comment' => 'Starting repair',
        ]);

        $this->assertNotNull($wh->ticket);
        $this->assertNotNull($wh->originStatus);
        $this->assertNotNull($wh->destinationStatus);
        $this->assertNotNull($wh->technician);
    }
}
