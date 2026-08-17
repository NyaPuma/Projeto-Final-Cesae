<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    public function test_switch_lang_redirects_guest_to_login_with_locale_cookie(): void
    {
        $this->get('/lang/pt-PT')
            ->assertRedirect(route('ui.login'))
            ->assertCookie('locale', 'pt-PT');

        $this->get('/lang/en-GB')
            ->assertRedirect(route('ui.login'))
            ->assertCookie('locale', 'en-GB');
    }

    public function test_switch_lang_defaults_invalid_locale_to_default(): void
    {
        $this->get('/lang/xx')
            ->assertRedirect(route('ui.login'))
            ->assertCookie('locale', 'pt-PT');
    }

    public function test_switch_lang_sanitizes_legacy_short_codes(): void
    {
        $this->get('/lang/en')
            ->assertRedirect(route('ui.login'))
            ->assertCookie('locale', 'en-GB');
    }

    public function test_switch_lang_redirects_authenticated_user_to_dashboard(): void
    {
        $this->call('GET', '/lang/pt-PT', [], ['api_token' => 'some-token'])
            ->assertRedirect(route('ui.index'));
    }

    public function test_test_email_route_sends_raw_message(): void
    {
        Mail::fake();

        $this->get('/test-email')
            ->assertOk()
            ->assertSee('E-mail enviado com sucesso!');
    }

    public function test_password_reset_form_renders_with_token(): void
    {
        $token = Str::random(40);

        $this->get('/api/password/reset/'.$token)
            ->assertOk()
            ->assertViewIs('ui.auth-reset')
            ->assertViewHas('token', $token);
    }
}
