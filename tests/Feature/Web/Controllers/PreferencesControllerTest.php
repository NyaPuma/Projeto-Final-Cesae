<?php

declare(strict_types=1);

namespace Tests\Feature\Web\Controllers;

use Tests\Base\FeatureTestCase;

final class PreferencesControllerTest extends FeatureTestCase
{
    public function test_preferences_edit_page_renders_successfully(): void
    {
        // Act
        $response = $this->get('/preferences');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('preferences.edit');
        $response->assertViewHas('supportedLocales');
        $response->assertViewHas('supportedCurrencies');
    }

    public function test_guest_can_update_language_via_session(): void
    {
        // Act
        $response = $this->post('/preferences/language', [
            'language' => 'en',
        ]);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHas('locale', 'en-GB');
    }

    public function test_authenticated_user_can_update_currency_json(): void
    {
        // Arrange
        $user = $this->createRegularUser();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->postJson('/preferences/currency', [
                'currency' => 'USD',
            ]);

        // Assert
        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('currency', 'USD');
    }

    public function test_authenticated_user_can_update_all_preferences(): void
    {
        // Arrange
        $user = $this->createRegularUser();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->postJson('/preferences', [
                'language' => 'pt-PT',
                'currency' => 'EUR',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'number_format' => '1.234,56',
            ]);

        // Assert
        $response->assertStatus(200)
            ->assertJsonPath('success', true);

        $this->assertSame('pt-PT', $user->fresh()->locale);
    }
}
