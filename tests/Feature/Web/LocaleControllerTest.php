<?php

namespace Tests\Feature\Web;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LocaleControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guest_can_switch_locale_and_gets_session_and_cookie(): void
    {
        $this->from('/')
            ->post('/locale', ['locale' => 'pt-BR'])
            ->assertRedirect('/');

        $this->get('/ui/login')
            ->assertSessionHas('locale', 'pt-BR');
    }

    #[Test]
    public function switching_locale_sets_forever_cookie(): void
    {
        $this->post('/locale', ['locale' => 'en-US'])
            ->assertCookie('locale', 'en-US');
    }

    #[Test]
    public function unsupported_locale_is_rejected_by_the_whitelist(): void
    {
        $this->post('/locale', ['locale' => 'zz-ZZ'])
            ->assertSessionHasErrors('locale');
    }

    #[Test]
    public function authenticated_user_locale_is_persisted_to_database(): void
    {
        $user = User::factory()->create([
            'active' => true,
            'api_token' => Str::random(60),
            'locale' => 'pt-PT',
        ]);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->post('/locale', ['locale' => 'en-US'])
            ->assertCookie('locale', 'en-US');

        $this->assertSame('en-US', $user->fresh()->locale);
    }
}
