<?php

namespace Tests\Unit;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\Userprofile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_profile_belongs_to_user()
    {
        $profile = Userprofile::create(['name' => UserRoleEnum::User->value]);
        $user = User::factory()->create(['profile_id' => $profile->id]);

        $this->assertEquals($profile->id, $user->profile->id);
        $this->assertEquals(UserRoleEnum::User->value, $user->profile->name);
    }
}
