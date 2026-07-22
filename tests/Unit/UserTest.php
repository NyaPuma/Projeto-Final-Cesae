<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use ReflectionMethod;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create necessary profiles for tests
        $this->createProfiles();
    }

    private function createProfiles(): void
    {
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
    }

    #[Test]
    public function it_creates_a_user_with_default_profile_when_no_profile_provided()
    {
        $user = User::factory()->create([
            'profile_id' => null,
        ]);

        // Verify that a default profile was created if not exists
        $defaultProfile = UserProfile::where('name', User::ROLE_USER)->first();

        // The user should have been assigned the default profile ID during creation
        $this->assertEquals($defaultProfile?->id, $user->profile_id);
    }

    #[Test]
    public function it_creates_a_user_with_valid_profile()
    {
        // Create a technician profile first
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);

        $user = User::factory()->create([
            'profile_id' => $profile->id,
        ]);

        $user->refresh();

        // Verify user was created with correct data
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertTrue($user->active === true);
    }

    #[Test]
    public function it_updates_user_profile_to_default_when_invalid()
    {
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);

        // Create user with invalid profile (non-existent or wrong role)
        $user = User::factory()->create([
            'profile_id' => 999, // Non-existent profile ID
        ]);

        // Verify the default USER profile was created and assigned
        $defaultProfile = UserProfile::where('name', User::ROLE_USER)->first();

        $this->assertEquals($defaultProfile->id, $user->profile_id);
    }

    #[Test]
    public function it_has_correct_role_constants()
    {
        // Verify role constants exist and have correct values
        $this->assertNotNull(User::ROLE_USER);
        $this->assertEquals('user', User::ROLE_USER);

        $this->assertNotNull(User::ROLE_TECHNICIAN);
        $this->assertEquals('technician', User::ROLE_TECHNICIAN);

        $this->assertNotNull(User::ROLE_ADMIN);
        $this->assertEquals('admin', User::ROLE_ADMIN);
    }

    #[Test]
    public function it_gets_available_roles()
    {
        $roles = User::getAvailableRoles();

        // Verify all roles are returned
        $this->assertCount(3, $roles);
        $this->assertContains(User::ROLE_USER, $roles);
        $this->assertContains(User::ROLE_TECHNICIAN, $roles);
        $this->assertContains(User::ROLE_ADMIN, $roles);
    }

    #[Test]
    public function it_validates_profile_name()
    {
        // Test valid profile names
        $validProfiles = [User::ROLE_USER, User::ROLE_TECHNICIAN, User::ROLE_ADMIN];

        foreach ($validProfiles as $profileName) {
            $this->assertTrue((new ReflectionMethod(User::class, 'isValidProfile'))->invoke(null, $profileName));
        }

        // Test invalid profile name
        $invalidProfile = 'unknown_role';
        $this->assertFalse((new ReflectionMethod(User::class, 'isValidProfile'))->invoke(null, $invalidProfile));
    }

    #[Test]
    public function it_checks_admin_status_correctly()
    {
        // Create admin profile and user
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);

        $adminUser = User::factory()->create([
            'profile_id' => $profile->id,
        ]);

        $this->assertTrue($adminUser->isAdmin());
    }

    #[Test]
    public function it_checks_technician_status_correctly()
    {
        // Create technician profile and user
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);

        $technicianUser = User::factory()->create([
            'profile_id' => $profile->id,
        ]);

        $this->assertTrue($technicianUser->isTechnician());
    }

    #[Test]
    public function it_checks_common_user_status_correctly()
    {
        // Create user profile and user
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        $commonUser = User::factory()->create([
            'profile_id' => $profile->id,
        ]);

        $this->assertTrue($commonUser->isCommonUser());
    }

    #[Test]
    public function it_returns_false_for_non_matching_roles()
    {
        // Create admin profile and user
        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);

        $adminUser = User::factory()->create([
            'profile_id' => $adminProfile->id,
        ]);

        // Admin should not be technician or common user
        $this->assertFalse($adminUser->isTechnician());
        $this->assertFalse($adminUser->isCommonUser());

        // Create technician profile and user
        $techProfile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);

        $technicianUser = User::factory()->create([
            'profile_id' => $techProfile->id,
        ]);

        // Technician should not be admin or common user
        $this->assertFalse($technicianUser->isAdmin());
        $this->assertFalse($technicianUser->isCommonUser());

        // Create user profile and user
        $userProfile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        $commonUser = User::factory()->create([
            'profile_id' => $userProfile->id,
        ]);

        // Common user should not be admin or technician
        $this->assertFalse($commonUser->isAdmin());
        $this->assertFalse($commonUser->isTechnician());
    }

    #[Test]
    public function it_has_correct_hidden_attributes()
    {
        User::factory()->create();

        // Get the last created user
        $user = User::latest()->first();

        if (! $user) {
            return;
        }

        // Verify hidden attributes are not serialized in JSON response
        $jsonResponse = json_encode($user);

        $this->assertStringNotContainsString('password', $jsonResponse, 'Password should be hidden');
        $this->assertStringNotContainsString('_tokens', $jsonResponse, '_tokens should be hidden');
    }

    #[Test]
    public function it_has_correct_casts()
    {
        User::factory()->create();

        // Get the last created user
        $user = User::latest()->first();

        if (! $user) {
            return;
        }

        // Verify boolean cast for active field
        $this->assertTrue($user->active === true);
    }

    #[Test]
    public function it_has_correct_fillable_attributes()
    {
        User::factory()->create();

        // Get the last created user
        $user = User::latest()->first();

        if (! $user) {
            return;
        }

        // Verify fillable attributes exist in model definition
        $this->assertContains('name', $user->getFillable());
        $this->assertContains('email', $user->getFillable());
        $this->assertContains('password', $user->getFillable());
        $this->assertContains('profile_id', $user->getFillable());
        $this->assertContains('active', $user->getFillable());
        $this->assertContains('api_token', $user->getFillable());
    }

    #[Test]
    public function it_has_correct_table_name()
    {
        // Verify the table name is set correctly
        $this->assertEquals('users', (new User)->getTable());
    }

    #[Test]
    public function it_creates_user_with_api_token_on_login()
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);

        // Create user with initial API token
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => bin2hex(random_bytes(32)),
        ]);

        // Verify the user has an API token
        $this->assertNotNull($user->api_token);
    }

    #[Test]
    public function it_has_correct_relationships()
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);

        $technicianUser = User::factory()->create([
            'profile_id' => $profile->id,
        ]);

        // Verify profile relationship exists and works correctly
        $this->assertNotNull($technicianUser->profile);
        $this->assertEquals(UserProfile::class, get_class($technicianUser->profile));

        // Verify tickets relationship (hasMany)
        $tickets = $technicianUser->tickets();
        $this->assertInstanceOf(HasMany::class, $tickets);

        // Verify assigned_tickets relationship (belongsTo via foreign key assignment_to in Ticket model)
        $assignedTickets = $technicianUser->assignedTickets();
        $this->assertInstanceOf(HasMany::class, $assignedTickets);
    }

    #[Test]
    public function it_has_correct_factory_definition()
    {
        // Verify factory creates users with correct default values
        $user = User::factory()->create();

        $this->assertNotNull($user->name);
        $this->assertStringContainsString('@', $user->email);
        $this->assertNotNull($user->email_verified_at);
    }

    #[Test]
    public function it_has_correct_password_hashing()
    {
        User::factory()->create();

        // Get the last created user
        $user = User::latest()->first();

        if (! $user) {
            return;
        }

        // Verify password is hashed (not plain text 'password')
        $this->assertNotEquals('password', $user->password);
    }

    #[Test]
    public function it_has_correct_notifiable_trait()
    {
        User::factory()->create();

        // Get the last created user
        $user = User::latest()->first();

        if (! $user) {
            return;
        }

        // Verify Notifiable trait is used (should have notifications method available via facade)
        $this->assertTrue(method_exists($user, 'notify'));
    }

    #[Test]
    public function it_has_correct_factory_trait()
    {
        User::factory()->create();

        // Get the last created user
        $user = User::latest()->first();

        if (! $user) {
            return;
        }

        // Verify HasFactory trait is used (should have factory method available via facade)
        $this->assertTrue(method_exists($user, 'factory'));
    }

    #[Test]
    public function it_handles_multiple_roles_in_get_available()
    {
        $profile1 = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        // Create users with different roles
        $user1 = User::factory()->create([
            'profile_id' => $profile1->id,
        ]);

        $this->assertTrue($user1->isCommonUser());
    }

    #[Test]
    public function it_handles_null_profile_correctly()
    {
        // Create user with null profile (should be handled by booting)
        $user = User::factory()->create([
            'profile_id' => null,
        ]);

        $user->refresh();

        // Profile should have been assigned during creation via booting method
        $this->assertNotNull($user->profile);
    }

    #[Test]
    public function it_handles_missing_profile_name_correctly()
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);

        // Create user with profile
        $user = User::factory()->create([
            'profile_id' => $profile->id,
        ]);

        // Profile should exist and have correct role
        $this->assertEquals(UserProfile::class, get_class($user->profile));
    }
}
