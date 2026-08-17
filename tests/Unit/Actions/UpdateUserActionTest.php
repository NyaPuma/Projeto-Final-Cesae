<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateUserAction;
use App\DTOs\UpdateUserData;
use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class UpdateUserActionTest extends FeatureTestCase
{
    private UpdateUserAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = app(UpdateUserAction::class);
    }

    #[Test]
    public function it_updates_the_user_name(): void
    {
        $user = User::factory()->create(["active" => true]);

        $result = $this->action->execute(
            $user,
            new UpdateUserData(name: '  Novo Nome Completo  ')
        );

        $this->assertEquals('Novo Nome Completo', $result->name);
    }

    #[Test]
    public function it_normalizes_the_email_to_lowercase(): void
    {
        $user = User::factory()->create(['active' => true, 'email' => 'original@example.com']);

        $result = $this->action->execute(
            $user,
            new UpdateUserData(email: 'NovoEmail@Example.COM')
        );

        $this->assertEquals('novoemail@example.com', $result->email);
    }

    #[Test]
    public function it_keeps_the_existing_email_when_not_provided(): void
    {
        $user = User::factory()->create(['active' => true, 'email' => 'keep@example.com']);

        $result = $this->action->execute(
            $user,
            new UpdateUserData(name: 'Renomeado')
        );

        $this->assertEquals('keep@example.com', $result->email);
    }

    #[Test]
    public function it_deactivates_the_user_when_requested(): void
    {
        $user = User::factory()->create(['active' => true]);

        $result = $this->action->execute(
            $user,
            new UpdateUserData(active: false)
        );

        $this->assertFalse($result->active);
    }

    #[Test]
    public function it_switches_the_user_profile_when_a_profile_id_is_provided(): void
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        $user = User::factory()->create(["active" => true]);

        $result = $this->action->execute(
            $user,
            new UpdateUserData(profileId: $profile->id)
        );

        $this->assertEquals($profile->id, $result->profile_id);
        $this->assertEquals($profile->id, $result->profile->id);
    }

    #[Test]
    public function it_keeps_the_current_profile_when_none_is_provided(): void
    {
        $user = User::factory()->create(['active' => true, 'profile_id' => UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value])->id]);

        $result = $this->action->execute(
            $user,
            new UpdateUserData(name: 'Sem troca de perfil')
        );

        $this->assertEquals($user->profile_id, $result->profile_id);
    }
}
