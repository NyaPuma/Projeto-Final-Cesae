<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserPreference;
use App\Services\PreferencesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * Tests for user preferences functionality (Part 4).
 *
 * Tests that:
 * - Language, currency, and date format are independent controls
 * - Changing one does not affect the others
 * - Defaults are applied correctly
 */
class UserPreferencesTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    #[Test]
    public function it_creates_preferences_with_defaults_for_new_user(): void
    {
        // Migration should create preferences with defaults
        $this->artisan('migrate', ['--force' => true])->run();

        $prefs = PreferencesService::forUser($this->user);

        $this->assertEquals('pt-PT', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    #[Test]
    public function it_updates_language_without_affecting_currency_and_date_format(): void
    {
        // Create initial preferences
        PreferencesService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Update only language
        PreferencesService::saveForUser($this->user, [
            'language' => 'en-GB',
            'currency' => 'EUR', // Keeps same
            'date_format' => 'd/m/Y', // Keeps same
        ]);

        $prefs = PreferencesService::forUser($this->user);

        $this->assertEquals('en-GB', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']); // Did not change
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Did not change
    }

    #[Test]
    public function it_updates_currency_without_affecting_language_and_date_format(): void
    {
        // Create initial preferences
        PreferencesService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Update only currency
        PreferencesService::saveForUser($this->user, [
            'language' => 'pt', // Keeps same
            'currency' => 'USD',
            'date_format' => 'd/m/Y', // Keeps same
        ]);

        $prefs = PreferencesService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']); // Did not change
        $this->assertEquals('USD', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Did not change
    }

    #[Test]
    public function it_updates_date_format_without_affecting_language_and_currency(): void
    {
        // Create initial preferences
        PreferencesService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Update only date format
        PreferencesService::saveForUser($this->user, [
            'language' => 'pt', // Keeps same
            'currency' => 'EUR', // Keeps same
            'date_format' => 'Y-m-d',
        ]);

        $prefs = PreferencesService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']); // Did not change
        $this->assertEquals('EUR', $prefs['currency']); // Did not change
        $this->assertEquals('Y-m-d', $prefs['date_format']);
    }

    #[Test]
    public function it_updates_all_preferences_independently(): void
    {
        // Update everything at once
        PreferencesService::saveForUser($this->user, [
            'language' => 'en-US',
            'currency' => 'USD',
            'date_format' => 'm/d/Y',
        ]);

        $prefs = PreferencesService::forUser($this->user);

        $this->assertEquals('en-US', $prefs['language']);
        $this->assertEquals('USD', $prefs['currency']);
        $this->assertEquals('m/d/Y', $prefs['date_format']);
    }

    #[Test]
    public function it_validates_language(): void
    {
        // Unsupported language should use default
        $prefs = PreferencesService::validatePreferences([
            'language' => 'xx-XX', // Does not exist
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('pt-PT', $prefs['language']); // Should be default
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    #[Test]
    public function it_validates_currency(): void
    {
        // Invalid currency should use default
        $prefs = PreferencesService::validatePreferences([
            'language' => 'pt',
            'currency' => 'INVALID',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']); // Should be default
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    #[Test]
    public function it_validates_date_format(): void
    {
        // Invalid date format should use default
        $prefs = PreferencesService::validatePreferences([
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'INVALID_FORMAT',
        ]);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Should be default
    }

    #[Test]
    public function it_accepts_valid_currencies(): void
    {
        // Test valid currencies
        $validCurrencies = ['EUR', 'USD', 'GBP', 'BRL', 'JPY', 'CNY'];

        foreach ($validCurrencies as $currency) {
            $prefs = PreferencesService::validatePreferences([
                'language' => 'pt',
                'currency' => $currency,
                'date_format' => 'd/m/Y',
            ]);

            $this->assertEquals($currency, $prefs['currency']);
        }
    }

    #[Test]
    public function it_accepts_valid_date_formats(): void
    {
        // Test valid date formats
        $validFormats = ['d/m/Y', 'm/d/Y', 'Y-m-d', 'd-m-Y', 'Y/m/d', 'd.m.Y', 'm-d-Y'];

        foreach ($validFormats as $format) {
            $prefs = PreferencesService::validatePreferences([
                'language' => 'pt',
                'currency' => 'EUR',
                'date_format' => $format,
            ]);

            $this->assertEquals($format, $prefs['date_format']);
        }
    }

    #[Test]
    public function it_returns_defaults_for_non_authenticated_user(): void
    {
        // For unauthenticated user, should return defaults
        $prefs = PreferencesService::forUser($this->user);

        // If no preferences in DB
        UserPreference::where('user_id', $this->user->id)->delete();

        $prefs = PreferencesService::forUser($this->user);

        $this->assertEquals('pt-PT', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    #[Test]
    public function it_updates_only_specified_fields(): void
    {
        // Create initial preferences
        PreferencesService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Update only currency (simulating what controller does)
        // Controller passes current values for fields not being updated
        $currentPrefs = PreferencesService::forUser($this->user);
        
        PreferencesService::saveForUser($this->user, [
            'language' => $currentPrefs['language'],
            'currency' => 'GBP',
            'date_format' => $currentPrefs['date_format'],
        ]);

        $prefs = PreferencesService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']); // Kept as stored base code
        $this->assertEquals('GBP', $prefs['currency']); // Updated
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Kept
    }
}
