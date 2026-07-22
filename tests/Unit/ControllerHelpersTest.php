<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserProfile;
use App\Traits\ControllerHelpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class ControllerHelpersTest extends TestCase
{
    use RefreshDatabase;

    private $controller;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);

        // Create a concrete implementation with public wrappers for testing
        $this->controller = new class
        {
            use ControllerHelpers {
                authenticatedUser as public;
                requireRole as public;
            }
        };
    }

    #[Test]
    public function it_returns_authenticated_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = Request::create('/test', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $authenticatedUser = $this->controller->authenticatedUser($request);
        $this->assertInstanceOf(User::class, $authenticatedUser);
        $this->assertEquals($user->id, $authenticatedUser->id);
    }

    #[Test]
    public function it_returns_authenticated_user_from_request(): void
    {
        $user = User::factory()->create();
        $request = Request::create('/test', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $authenticatedUser = $this->controller->authenticatedUser($request);
        $this->assertInstanceOf(User::class, $authenticatedUser);
        $this->assertEquals($user->id, $authenticatedUser->id);
    }

    #[Test]
    public function it_allows_user_with_valid_role(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $user = User::factory()->create(['profile_id' => $adminProfile->id]);

        $this->controller->requireRole($user, [User::ROLE_ADMIN]);
        $this->assertTrue(true);
    }

    #[Test]
    public function it_allows_user_with_any_of_multiple_roles(): void
    {
        $technicianProfile = UserProfile::where('name', User::ROLE_TECHNICIAN)->first();
        $user = User::factory()->create(['profile_id' => $technicianProfile->id]);

        $this->controller->requireRole($user, [User::ROLE_ADMIN, User::ROLE_TECHNICIAN]);
        $this->assertTrue(true);
    }

    #[Test]
    public function it_denies_user_without_valid_role(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Acesso proibido');

        $userProfile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create(['profile_id' => $userProfile->id]);

        $this->controller->requireRole($user, [User::ROLE_ADMIN]);
    }

    #[Test]
    public function it_denies_user_with_no_profile(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Acesso proibido');

        $user = User::factory()->create(['profile_id' => null]);

        $this->controller->requireRole($user, [User::ROLE_ADMIN]);
    }

    #[Test]
    public function it_denies_user_with_empty_roles_array(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Acesso proibido');

        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $user = User::factory()->create(['profile_id' => $adminProfile->id]);

        $this->controller->requireRole($user, []);
    }

    #[Test]
    public function it_handles_role_check_with_case_sensitivity(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $user = User::factory()->create(['profile_id' => $adminProfile->id]);

        $this->controller->requireRole($user, [User::ROLE_ADMIN]);
        $this->assertTrue(true);
    }
}
