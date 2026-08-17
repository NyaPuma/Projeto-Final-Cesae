<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserPreference;
use App\Services\PreferenciasService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Testes para a funcionalidade de preferências do utilizador (Parte 4).
 * 
 * Testa que:
 * - Língua, moeda e formato de data são controlos independentes
 * - Mudar um não afeta os outros
 * - Defaults são aplicados corretamente
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

    /** @test */
    public function it_creates_preferences_with_defaults_for_new_user(): void
    {
        // A migration deve criar preferências com defaults
        $this->artisan('migrate', ['--force' => true])->run();

        $prefs = PreferenciasService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_updates_language_without_affecting_currency_and_date_format(): void
    {
        // Criar preferências iniciais
        PreferenciasService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Atualizar apenas a língua
        PreferenciasService::saveForUser($this->user, [
            'language' => 'en-GB',
            'currency' => 'EUR', // Mantém o mesmo
            'date_format' => 'd/m/Y', // Mantém o mesmo
        ]);

        $prefs = PreferenciasService::forUser($this->user);

        $this->assertEquals('en-GB', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']); // Não mudou
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Não mudou
    }

    /** @test */
    public function it_updates_currency_without_affecting_language_and_date_format(): void
    {
        // Criar preferências iniciais
        PreferenciasService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Atualizar apenas a moeda
        PreferenciasService::saveForUser($this->user, [
            'language' => 'pt', // Mantém o mesmo
            'currency' => 'USD',
            'date_format' => 'd/m/Y', // Mantém o mesmo
        ]);

        $prefs = PreferenciasService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']); // Não mudou
        $this->assertEquals('USD', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Não mudou
    }

    /** @test */
    public function it_updates_date_format_without_affecting_language_and_currency(): void
    {
        // Criar preferências iniciais
        PreferenciasService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Atualizar apenas o formato de data
        PreferenciasService::saveForUser($this->user, [
            'language' => 'pt', // Mantém o mesmo
            'currency' => 'EUR', // Mantém o mesmo
            'date_format' => 'Y-m-d',
        ]);

        $prefs = PreferenciasService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']); // Não mudou
        $this->assertEquals('EUR', $prefs['currency']); // Não mudou
        $this->assertEquals('Y-m-d', $prefs['date_format']);
    }

    /** @test */
    public function it_updates_all_preferences_independently(): void
    {
        // Atualizar tudo de uma vez
        PreferenciasService::saveForUser($this->user, [
            'language' => 'en-US',
            'currency' => 'USD',
            'date_format' => 'm/d/Y',
        ]);

        $prefs = PreferenciasService::forUser($this->user);

        $this->assertEquals('en-US', $prefs['language']);
        $this->assertEquals('USD', $prefs['currency']);
        $this->assertEquals('m/d/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_validates_language(): void
    {
        // Lingua não suportada deve usar o default
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'xx-XX', // Não existe
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('pt', $prefs['language']); // Deve ser o default
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_validates_currency(): void
    {
        // Moeda inválida deve usar o default
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'pt',
            'currency' => 'INVALID',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']); // Deve ser o default
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_validates_date_format(): void
    {
        // Formato de data inválido deve usar o default
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'INVALID_FORMAT',
        ]);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Deve ser o default
    }

    /** @test */
    public function it_accepts_valid_currencies(): void
    {
        // Testar moedas válidas
        $validCurrencies = ['EUR', 'USD', 'GBP', 'BRL', 'JPY', 'CNY'];

        foreach ($validCurrencies as $currency) {
            $prefs = PreferenciasService::validatePreferences([
                'language' => 'pt',
                'currency' => $currency,
                'date_format' => 'd/m/Y',
            ]);

            $this->assertEquals($currency, $prefs['currency']);
        }
    }

    /** @test */
    public function it_accepts_valid_date_formats(): void
    {
        // Testar formatos de data válidos
        $validFormats = ['d/m/Y', 'm/d/Y', 'Y-m-d', 'd-m-Y', 'Y/m/d', 'd.m.Y', 'm-d-Y'];

        foreach ($validFormats as $format) {
            $prefs = PreferenciasService::validatePreferences([
                'language' => 'pt',
                'currency' => 'EUR',
                'date_format' => $format,
            ]);

            $this->assertEquals($format, $prefs['date_format']);
        }
    }

    /** @test */
    public function it_returns_defaults_for_non_authenticated_user(): void
    {
        // Para utilizador não autenticado, deve retornar os defaults
        $prefs = PreferenciasService::forUser($this->user);

        // Se não tiver preferências na BD
        UserPreference::where('user_id', $this->user->id)->delete();

        $prefs = PreferenciasService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_updates_only_specified_fields(): void
    {
        // Criar preferências iniciais
        PreferenciasService::saveForUser($this->user, [
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        // Atualizar apenas a moeda (simulando o que o controller faz)
        // O controller passará os valores atuais para os campos que não estão a ser atualizados
        $currentPrefs = PreferenciasService::forUser($this->user);
        
        PreferenciasService::saveForUser($this->user, [
            'language' => $currentPrefs['language'],
            'currency' => 'GBP',
            'date_format' => $currentPrefs['date_format'],
        ]);

        $prefs = PreferenciasService::forUser($this->user);

        $this->assertEquals('pt', $prefs['language']); // Mantido
        $this->assertEquals('GBP', $prefs['currency']); // Atualizado
        $this->assertEquals('d/m/Y', $prefs['date_format']); // Mantido
    }
}
