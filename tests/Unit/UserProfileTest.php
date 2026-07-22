<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Userprofile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_profile_belongs_to_user()
    {
        $profile = Userprofile::create(['name' => User::ROLE_USER]);
        $user = User::factory()->create(['profile_id' => $profile->id]);

        $this->assertEquals($profile->id, $user->profile->id);
        $this->assertEquals(User::ROLE_USER, $user->profile->name);
    }
}
