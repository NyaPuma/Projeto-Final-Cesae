<?php

namespace Tests\Feature;

use App\Mail\TestMail;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class MailgunTestEmailTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
    }

    public function test_authenticated_user_can_send_mailgun_test_email(): void
    {
        Mail::fake();

        $profile = UserProfile::where('name', User::ROLE_USER)->first();

        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'email' => 'teacher@example.com',
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/notifications/test-email');

        $response->assertOk();
        $response->assertJsonPath('mailer', 'mailgun_fallback');

        Mail::assertSent(TestMail::class, function (TestMail $mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
