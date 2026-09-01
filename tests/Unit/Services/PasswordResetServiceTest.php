<?php

namespace Tests\Unit\Services;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Services\PasswordResetService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class PasswordResetServiceTest extends FeatureTestCase
{
    private PasswordResetService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PasswordResetService;
    }

    #[Test]
    public function it_creates_a_reset_token_and_persists_a_hashed_version(): void
    {
        $user = $this->createUserWithPassword(
            UserRoleEnum::User->value,
            'joao@example.com',
            'SenhaForte123'
        );

        $token = $this->service->createResetToken($user->email);

        $this->assertEquals(64, strlen($token));

        $record = DB::table('password_reset_tokens')->where('email', 'joao@example.com')->first();

        $this->assertNotNull($record);
        $this->assertNotEquals($token, $record->token);
        $this->assertTrue(Hash::check($token, $record->token));
    }

    #[Test]
    public function it_normalizes_the_email_to_lowercase_when_storing_the_token(): void
    {
        $token = $this->service->createResetToken('JOAO.TESTE@Example.com');

        $record = DB::table('password_reset_tokens')->where('email', 'joao.teste@example.com')->first();

        $this->assertNotNull($record);
        $this->assertNotNull($token);
    }

    #[Test]
    public function it_updates_an_existing_token_for_the_same_email(): void
    {
        $this->service->createResetToken('user@example.com');
        $secondToken = $this->service->createResetToken('user@example.com');

        $records = DB::table('password_reset_tokens')->where('email', 'user@example.com')->count();

        $this->assertEquals(1, $records);
        $this->assertNotNull($secondToken);
    }

    #[Test]
    public function it_validates_a_valid_token_and_returns_the_user(): void
    {
        $user = $this->createUserWithPassword(
            UserRoleEnum::User->value,
            'ana@example.com',
            'SenhaForte123'
        );

        $token = $this->service->createResetToken($user->email);

        $result = $this->service->validateToken('ANA@example.com', $token);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($user->id, $result->id);
    }

    #[Test]
    public function it_returns_null_for_an_invalid_token(): void
    {
        $user = $this->createUserWithPassword(
            UserRoleEnum::User->value,
            'carlos@example.com',
            'SenhaForte123'
        );

        $this->service->createResetToken($user->email);

        $this->assertNull($this->service->validateToken($user->email, Str::random(64)));
    }

    #[Test]
    public function it_returns_null_for_an_unknown_email(): void
    {
        $this->assertNull($this->service->validateToken('nao-existe@example.com', Str::random(64)));
    }

    #[Test]
    public function it_rejects_and_deletes_expired_tokens(): void
    {
        $user = $this->createUserWithPassword(
            UserRoleEnum::User->value,
            'maria@example.com',
            'SenhaForte123'
        );

        $token = $this->service->createResetToken($user->email);

        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->update(['created_at' => now()->subMinutes(61)]);

        $result = $this->service->validateToken($user->email, $token);

        $this->assertNull($result);
        $this->assertEquals(0, DB::table('password_reset_tokens')->where('email', $user->email)->count());
    }

    #[Test]
    public function it_accepts_a_token_within_the_expiry_window(): void
    {
        $user = $this->createUserWithPassword(
            UserRoleEnum::User->value,
            'pedro@example.com',
            'SenhaForte123'
        );

        $token = $this->service->createResetToken($user->email);

        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->update(['created_at' => now()->subMinutes(30)]);

        $this->assertNotNull($this->service->validateToken($user->email, $token));
    }

    #[Test]
    public function it_resets_the_password_clears_the_api_token_and_removes_the_record(): void
    {
        $user = $this->createUserWithPassword(
            UserRoleEnum::User->value,
            'rita@example.com',
            'SenhaForte123'
        );

        $this->service->createResetToken($user->email);

        $this->service->resetPassword($user, 'NovaSenhaSegura456');

        $this->assertTrue(Hash::check('NovaSenhaSegura456', $user->fresh()->password));
        $this->assertNotEquals('SenhaForte123', $user->fresh()->password);
        $this->assertNull($user->fresh()->api_token);
        $this->assertEquals(0, DB::table('password_reset_tokens')->where('email', $user->email)->count());
    }
}
