<?php

namespace Tests\Unit\Repositories;

use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\Contracts\EquipmentRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesUsers;

class RepositoriesTest extends FeatureTestCase
{
    use CreatesUsers;

    private UserRepositoryInterface $users;
    private RoomRepositoryInterface $rooms;
    private EquipmentRepositoryInterface $equipment;
    private TicketRepositoryInterface $tickets;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = app(UserRepositoryInterface::class);
        $this->rooms = app(RoomRepositoryInterface::class);
        $this->equipment = app(EquipmentRepositoryInterface::class);
        $this->tickets = app(TicketRepositoryInterface::class);
    }

    private function userOf(string $role): User
    {
        return User::factory()->create([
            'profile_id' => UserProfile::where('name', $role)->first()->id,
        ]);
    }

    public function test_find_by_email_is_case_insensitive_and_returns_null_when_missing(): void
    {
        $user = $this->userOf(UserRoleEnum::User->value);

        $this->assertSame($user->id, $this->users->findByEmail(strtoupper($user->email))?->id);
        $this->assertNull($this->users->findByEmail('nao.existe@teste.pt'));
    }

    public function test_get_active_technicians_returns_only_active_technicians_with_id_and_name(): void
    {
        $tech = $this->userOf(UserRoleEnum::Technician->value);
        $inactiveTech = $this->userOf(UserRoleEnum::Technician->value);
        $inactiveTech->update(['active' => false]);
        $admin = $this->userOf(UserRoleEnum::Admin->value);

        $result = $this->users->getActiveTechnicians();

        $this->assertCount(1, $result);
        $this->assertSame($tech->id, $result[0]['id']);
        $this->assertSame(['id', 'name'], array_keys($result[0]));
        $adminIds = array_column($this->users->getAdmins(), 'id');
        $this->assertContains($admin->id, $adminIds);
        $this->assertNotContains($tech->id, $adminIds);
    }

    public function test_inactivate_updates_active_flag(): void
    {
        $user = $this->userOf(UserRoleEnum::User->value);

        $this->assertTrue($this->users->inactivate($user));
        $this->assertFalse($user->fresh()->active);
    }

    public function test_room_repository_crud_and_get_active_only(): void
    {
        $active = Room::factory()->create(['active' => true, 'name' => 'A']);
        Room::factory()->create(['active' => false, 'name' => 'B']);

        $result = $this->rooms->getActive();
        $this->assertCount(1, $result);
        $this->assertSame($active->id, $result[0]['id']);
        $this->assertSame(['id', 'name', 'code', 'location'], array_keys($result[0]));

        $this->assertSame($active->id, $this->rooms->findById($active->id)?->id);
        $this->assertNull($this->rooms->findById(999999));

        $this->assertTrue($this->rooms->update($active, ['location' => 'Novo local']));
        $this->assertSame('Novo local', $active->fresh()->location);

        $this->assertTrue($this->rooms->inactivate($active));
        $this->assertFalse($active->fresh()->active);
        $this->assertCount(0, $this->rooms->getActive());
    }

    public function test_equipment_repository_crud(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $created = $this->equipment->create([
            'name' => 'Monitor',
            'serial' => 'SN-' . fake()->unique()->bothify('####'),
            'category_id' => $category->id,
            'room_id' => $room->id,
        ]);

        $this->assertInstanceOf(Equipment::class, $created);
        $this->assertSame($created->id, $this->equipment->findById($created->id)?->id);

        $this->assertTrue($this->equipment->update($created, ['name' => 'Teclado']));
        $this->assertSame('Teclado', $created->fresh()->name);

        $this->assertTrue($this->equipment->delete($created));
        $this->assertNull($this->equipment->findById($created->id));
    }

    public function test_ticket_repository_scoped_lists(): void
    {
        $technician = $this->userOf(UserRoleEnum::Technician->value);
        $user = $this->userOf(UserRoleEnum::User->value);

        Ticket::factory()->create(['user_id' => $user->id]);
        Ticket::factory()->create(['user_id' => $user->id, 'assigned_to' => $technician->id]);
        Ticket::factory()->create(['user_id' => $user->id, 'assigned_to' => $technician->id, 'status_id' => 4]);

        $this->assertSame(3, $this->tickets->getAll()->total());
        $this->assertSame(3, $this->tickets->getTicketsByUser($user->id)->total());
        $this->assertSame(2, $this->tickets->getTicketsByTechnician($technician->id)->total());

        $statusId = $this->tickets->getAll()->first()->status_id;
        $openId = app(\App\Services\TicketStatusService::class)->getByName(\App\Enums\TicketStatusEnum::Open);
        $openCount = Ticket::where('status_id', $openId)->count();
        $this->assertSame($openCount, $this->tickets->getOpenTickets()->total());
        foreach ($this->tickets->getOpenTickets() as $ticket) {
            $this->assertSame($openId, $ticket->status_id);
        }
        $this->assertNotNull($statusId);
    }
}
