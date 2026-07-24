<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthFlowDebugTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
    }

    public function test_debug_auth_flow(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->firstOrFail()->id,
            'active' => true,
            'password' => Hash::make('password123'),
            'api_token' => Str::random(60),
        ]);

        $loginResponse = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $loginResponse->assertOk();
        $token = $loginResponse->json('token');
        $this->assertNotEmpty($token, 'Token should not be empty');

        $dbUser = User::where('email', $user->email)->first();
        $this->assertNotNull($dbUser->api_token, 'api_token should be set in DB');
        $expectedHash = User::hashToken($token);
        $this->assertEquals($expectedHash, $dbUser->api_token, 'DB token should match hash of returned token');

        // Verify the lookup would work directly
        $foundUser = User::with('profile')->where('api_token', $expectedHash)->where('active', true)->first();
        $this->assertNotNull($foundUser, 'Direct DB lookup should find user');

        // Verify the middleware would find the user
        $hashToken = User::hashToken($token);
        $foundByHash = User::where('api_token', $hashToken)->where('active', true)->first();
        $this->assertNotNull($foundByHash, 'User should be findable by hashed token');

        $foundByPlain = User::where('api_token', $token)->where('active', true)->first();
        dump('Found by plain token: '.($foundByPlain ? 'yes' : 'no'));
        dump('Token length: '.strlen($token));
        dump('Hash: '.$hashToken);
        dump('Hash length: '.strlen($hashToken));
        dump('DB api_token: '.$dbUser->api_token);
        dump('DB api_token length: '.strlen($dbUser->api_token));

        $uiResponse = $this
            ->withHeader('X-Auth-Token', $token)
            ->get('/ui');

        dump('Response status: '.$uiResponse->status());
        $logs = Log::getLogger()->getHandlers();
        dump('Response header location: '.($uiResponse->headers->get('Location') ?? 'none'));

        $this->assertTrue(true, 'Just dump debug info');
    }
}
