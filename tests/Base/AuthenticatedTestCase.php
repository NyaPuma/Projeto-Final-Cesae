<?php

namespace Tests\Base;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

abstract class AuthenticatedTestCase extends BaseTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected User $currentUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createViteManifest();
    }

    protected function actingAsUser(User $user): self
    {
        $this->currentUser = $user;

        return $this->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('Accept', 'application/json');
    }

    protected function actingAsAdmin(): self
    {
        $admin = $this->createUserWithProfile(User::ROLE_ADMIN);

        return $this->actingAsUser($admin);
    }

    protected function actingAsTechnician(): self
    {
        $technician = $this->createUserWithProfile(User::ROLE_TECHNICIAN);

        return $this->actingAsUser($technician);
    }

    protected function actingAsRegularUser(): self
    {
        $user = $this->createUserWithProfile(User::ROLE_USER);

        return $this->actingAsUser($user);
    }

    protected function createUserWithProfile(string $profileName, array $attributes = []): User
    {
        $profile = UserProfile::firstOrCreate(['name' => $profileName]);

        return User::factory()->create(array_merge([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ], $attributes));
    }

    protected function createUserWithPassword(string $profileName, string $email, string $password): User
    {
        $profile = UserProfile::firstOrCreate(['name' => $profileName]);

        return User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'profile_id' => $profile->id,
            'active' => true,
            'api_token' => Str::random(60),
        ]);
    }

    protected function assertAuthenticated(): void
    {
        $this->assertNotNull($this->currentUser);
        $this->assertNotNull($this->currentUser->api_token);
    }

    protected function assertGuest(): void
    {
        $this->assertNull($this->currentUser);
    }

    private function createViteManifest(): void
    {
        $buildDir = public_path('build');
        $manifest = $buildDir.'/manifest.json';

        @mkdir($buildDir, 0755, true);

        $existing = [];
        if (file_exists($manifest)) {
            $existing = json_decode(file_get_contents($manifest), true) ?: [];
        }

        $stub = $existing + [
            'resources/css/app.css' => [
                'file' => 'assets/app.css',
                'name' => 'app',
                'names' => ['app.css'],
                'src' => 'resources/css/app.css',
                'isEntry' => true,
            ],
            'resources/js/app.js' => [
                'file' => 'assets/app.js',
                'name' => 'app',
                'src' => 'resources/js/app.js',
                'isEntry' => true,
                'dynamicImports' => [
                    'resources/js/pages/auth.js',
                    'resources/js/pages/equipments.js',
                    'resources/js/pages/rooms.js',
                ],
            ],
            'resources/js/pages/auth.js' => [
                'file' => 'assets/auth.js',
                'name' => 'auth',
                'src' => 'resources/js/pages/auth.js',
                'isDynamicEntry' => true,
            ],
            'resources/js/pages/equipments.js' => [
                'file' => 'assets/equipments.js',
                'name' => 'equipments',
                'src' => 'resources/js/pages/equipments.js',
                'isDynamicEntry' => true,
            ],
            'resources/js/pages/rooms.js' => [
                'file' => 'assets/rooms.js',
                'name' => 'rooms',
                'src' => 'resources/js/pages/rooms.js',
                'isDynamicEntry' => true,
            ],
            'resources/css/swagger/swagger.css' => [
                'file' => 'assets/swagger.css',
                'name' => 'swagger',
                'src' => 'resources/css/swagger/swagger.css',
                'isEntry' => true,
            ],
            'resources/js/swagger/utils.js' => [
                'file' => 'assets/swagger-utils.js',
                'name' => 'swagger-utils',
                'src' => 'resources/js/swagger/utils.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/search.js' => [
                'file' => 'assets/swagger-search.js',
                'name' => 'swagger-search',
                'src' => 'resources/js/swagger/search.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/badges.js' => [
                'file' => 'assets/swagger-badges.js',
                'name' => 'swagger-badges',
                'src' => 'resources/js/swagger/badges.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/counters.js' => [
                'file' => 'assets/swagger-counters.js',
                'name' => 'swagger-counters',
                'src' => 'resources/js/swagger/counters.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/expand.js' => [
                'file' => 'assets/swagger-expand.js',
                'name' => 'swagger-expand',
                'src' => 'resources/js/swagger/expand.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/scrollspy.js' => [
                'file' => 'assets/swagger-scrollspy.js',
                'name' => 'swagger-scrollspy',
                'src' => 'resources/js/swagger/scrollspy.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/toolbar.js' => [
                'file' => 'assets/swagger-toolbar.js',
                'name' => 'swagger-toolbar',
                'src' => 'resources/js/swagger/toolbar.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/sidebar.js' => [
                'file' => 'assets/swagger-sidebar.js',
                'name' => 'swagger-sidebar',
                'src' => 'resources/js/swagger/sidebar.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/init.js' => [
                'file' => 'assets/swagger-init.js',
                'name' => 'swagger-init',
                'src' => 'resources/js/swagger/init.js',
                'isEntry' => true,
            ],
        ];

        file_put_contents($manifest, json_encode($stub, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
