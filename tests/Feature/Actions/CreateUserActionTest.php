<?php

namespace Tests\Feature\Actions;

use App\Actions\CreateUserAction;
use App\DTOs\StoreUserData;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class CreateUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_user(): void
    {
        UserProfile::factory()->create(['name' => 'user']);
        $action = new CreateUserAction(app('App\Services\UserService'));

        $data = new StoreUserData(
            name: 'Test User',
            email: 'test@example.com',
            password: 'password123',
            profileId: null,
            active: true,
        );

        $user = $action->execute($data);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'active' => true,
        ]);

        $this->assertNotNull($user->profile_id);
    }
}
