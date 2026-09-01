<?php

declare(strict_types=1);

namespace Tests\Feature\Middleware;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SetLocaleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_defaults_to_pt_pt_when_no_preference_set(): void
    {
        $response = $this->withHeaders(['Accept-Language' => ''])->get('/ui/login');
        $response->assertStatus(200);
        $this->assertEquals('pt-PT', app()->getLocale());
    }

    public function test_respects_session_locale(): void
    {
        $response = $this->withSession(['locale' => 'en-GB'])->get('/ui/login');
        $response->assertStatus(200);
        $this->assertEquals('en-GB', app()->getLocale());
    }

    public function test_respects_authenticated_user_locale_preference(): void
    {
        $profile = UserProfile::create(['name' => 'admin']);
        /** @var User $user */
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'locale' => 'pt-BR',
        ]);

        $response = $this->actingAs($user)->get('/ui');
        $this->assertEquals('pt-BR', app()->getLocale());
    }

    public function test_accepts_browser_accept_language_header(): void
    {
        $response = $this->withHeaders(['Accept-Language' => 'en-GB,en;q=0.9'])->get('/ui/login');
        $response->assertStatus(200);
        $this->assertEquals('en-GB', app()->getLocale());
    }

    public function test_locale_switch_endpoint_validates_whitelist(): void
    {
        $response = $this->post('/locale', ['locale' => 'invalid-locale']);
        $response->assertSessionHasErrors('locale');
    }

    public function test_locale_switch_endpoint_updates_session_and_user_db(): void
    {
        $profile = UserProfile::create(['name' => 'admin']);
        /** @var User $user */
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'locale' => 'pt-PT',
        ]);

        $response = $this->actingAs($user)->post('/locale', ['locale' => 'en-US']);
        $response->assertSessionHas('locale', 'en-US');

        $user->refresh();
        $this->assertEquals('en-US', $user->locale);
    }
}
