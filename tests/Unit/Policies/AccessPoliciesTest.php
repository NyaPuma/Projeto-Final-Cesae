<?php

namespace Tests\Unit\Policies;

use App\Enums\UserRoleEnum;
use App\Models\Audit;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\User;
use App\Models\UserProfile;
use App\Policies\AuditPolicy;
use App\Policies\EquipmentPolicy;
use App\Policies\RoomPolicy;
use App\Policies\UserPolicy;
use App\Policies\UserProfilePolicy;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;

class AccessPoliciesTest extends DatabaseTestCase
{
    private UserPolicy $userPolicy;
    private RoomPolicy $roomPolicy;
    private EquipmentPolicy $equipmentPolicy;
    private AuditPolicy $auditPolicy;
    private UserProfilePolicy $profilePolicy;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (UserRoleEnum::cases() as $role) {
            UserProfile::firstOrCreate(['name' => $role->value]);
        }

        $this->userPolicy = new UserPolicy;
        $this->roomPolicy = new RoomPolicy;
        $this->equipmentPolicy = new EquipmentPolicy;
        $this->auditPolicy = new AuditPolicy;
        $this->profilePolicy = new UserProfilePolicy;
    }

    private function userOf(string $role): User
    {
        return User::factory()->create([
            'profile_id' => UserProfile::where('name', $role)->first()->id,
        ]);
    }

    // --- UserPolicy ---

    #[Test]
    public function user_listing_is_only_for_staff(): void
    {
        $this->assertTrue($this->userPolicy->viewAny($this->userOf(UserRoleEnum::Admin->value)));
        $this->assertTrue($this->userPolicy->viewAny($this->userOf(UserRoleEnum::Technician->value)));
        $this->assertFalse($this->userPolicy->viewAny($this->userOf(UserRoleEnum::User->value)));
    }

    #[Test]
    public function user_can_view_self_and_staff_can_view_any_user(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $user = $this->userOf(UserRoleEnum::User->value);

        $this->assertTrue($this->userPolicy->view($admin, $user));
        $this->assertTrue($this->userPolicy->view($user, $user));
        $this->assertFalse($this->userPolicy->view($user, $admin));
    }

    #[Test]
    public function only_admin_can_create_users(): void
    {
        $this->assertTrue($this->userPolicy->create($this->userOf(UserRoleEnum::Admin->value)));
        $this->assertFalse($this->userPolicy->create($this->userOf(UserRoleEnum::Technician->value)));
    }

    #[Test]
    public function user_can_update_self_but_admin_can_update_anyone(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $user = $this->userOf(UserRoleEnum::User->value);

        $this->assertTrue($this->userPolicy->update($user, $user));
        $this->assertTrue($this->userPolicy->update($admin, $user));
        $this->assertFalse($this->userPolicy->update($user, $admin));
    }

    #[Test]
    public function admin_cannot_delete_self(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $other = $this->userOf(UserRoleEnum::User->value);

        $this->assertTrue($this->userPolicy->delete($admin, $other));
        $this->assertFalse($this->userPolicy->delete($admin, $admin));
        $this->assertFalse($this->userPolicy->delete($other, $admin));
    }

    #[Test]
    public function profile_update_allows_admin_or_self(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $user = $this->userOf(UserRoleEnum::User->value);

        $this->assertTrue($this->userPolicy->updateProfile($admin));
        $this->assertTrue($this->userPolicy->updateProfile($user, $user));
        $this->assertTrue($this->userPolicy->updateProfile($admin, $user));
        $this->assertFalse($this->userPolicy->updateProfile($user, $admin));
    }

    #[Test]
    public function admin_cannot_inactivate_self_or_another_admin(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $otherAdmin = $this->userOf(UserRoleEnum::Admin->value);
        $user = $this->userOf(UserRoleEnum::User->value);

        $this->assertTrue($this->userPolicy->inactivate($admin, $user));
        $this->assertFalse($this->userPolicy->inactivate($admin, $admin));
        $this->assertFalse($this->userPolicy->inactivate($admin, $otherAdmin));
        $this->assertFalse($this->userPolicy->inactivate($user, $admin));
    }

    #[Test]
    public function manage_and_manage_any_are_admin_only(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $user = $this->userOf(UserRoleEnum::User->value);

        $this->assertTrue($this->userPolicy->manage($admin));
        $this->assertFalse($this->userPolicy->manage($user));
        $this->assertTrue($this->userPolicy->manage($admin, $user));
        $this->assertFalse($this->userPolicy->manage($admin, $admin));
        $this->assertTrue($this->userPolicy->manageAny($admin));
        $this->assertFalse($this->userPolicy->manageAny($user));
    }

    // --- RoomPolicy / EquipmentPolicy ---

    #[Test]
    public function rooms_are_viewable_by_staff_and_manageable_by_admin(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $technician = $this->userOf(UserRoleEnum::Technician->value);
        $user = $this->userOf(UserRoleEnum::User->value);
        $room = Room::factory()->create();

        $this->assertTrue($this->roomPolicy->viewAny($admin));
        $this->assertTrue($this->roomPolicy->viewAny($technician));
        $this->assertFalse($this->roomPolicy->viewAny($user));
        $this->assertTrue($this->roomPolicy->view($technician, $room));
        $this->assertFalse($this->roomPolicy->view($user, $room));

        $this->assertTrue($this->roomPolicy->create($admin));
        $this->assertFalse($this->roomPolicy->create($technician));
        $this->assertTrue($this->roomPolicy->update($admin, $room));
        $this->assertFalse($this->roomPolicy->update($technician, $room));
        $this->assertTrue($this->roomPolicy->delete($admin, $room));
        $this->assertFalse($this->roomPolicy->delete($technician, $room));
        $this->assertTrue($this->roomPolicy->manage($admin));
        $this->assertFalse($this->roomPolicy->manageAny($technician));
    }

    #[Test]
    public function equipments_are_viewable_by_staff_and_manageable_by_admin(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $technician = $this->userOf(UserRoleEnum::Technician->value);
        $user = $this->userOf(UserRoleEnum::User->value);
        $equipment = Equipment::factory()->create();

        $this->assertTrue($this->equipmentPolicy->viewAny($technician));
        $this->assertFalse($this->equipmentPolicy->viewAny($user));
        $this->assertTrue($this->equipmentPolicy->view($technician, $equipment));
        $this->assertFalse($this->equipmentPolicy->view($user, $equipment));
        $this->assertTrue($this->equipmentPolicy->create($admin));
        $this->assertFalse($this->equipmentPolicy->create($technician));
        $this->assertTrue($this->equipmentPolicy->update($admin, $equipment));
        $this->assertFalse($this->equipmentPolicy->update($technician, $equipment));
        $this->assertTrue($this->equipmentPolicy->delete($admin, $equipment));
        $this->assertTrue($this->equipmentPolicy->manage($admin));
        $this->assertFalse($this->equipmentPolicy->manageAny($technician));
    }

    // --- AuditPolicy / UserProfilePolicy ---

    #[Test]
    public function audit_and_profile_listing_are_admin_only(): void
    {
        $admin = $this->userOf(UserRoleEnum::Admin->value);
        $technician = $this->userOf(UserRoleEnum::Technician->value);

        $this->assertTrue($this->auditPolicy->viewAny($admin));
        $this->assertFalse($this->auditPolicy->viewAny($technician));
        $this->assertTrue($this->profilePolicy->viewAny($admin));
        $this->assertFalse($this->profilePolicy->viewAny($technician));
    }
}
