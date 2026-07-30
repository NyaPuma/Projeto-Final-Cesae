<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;
use Tests\TestCase;

class MailgunTestEmailTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
    }

    public function test_authenticated_user_can_send_mailgun_test_email(): void
    {
        Bus::fake();

        $profile = UserProfile::where('name', UserRoleEnum::User->value)->first();

        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'email' => 'teacher@example.com',
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/notifications/test-email');

        $response->assertOk();
        $response->assertJsonPath('message', 'Email de teste em processamento via fila.');
    }
}
