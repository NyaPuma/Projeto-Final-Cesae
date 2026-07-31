<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Tests\TestCase;

class AssetPipelineTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    /**
     * As views de UI não podem conter CSS ou JS inline.
     * São permitidos: <script src="..."> (CDN/externos), o bloco síncrono de
     * prevenção de FOUC (tema dark/light) no <head> dos layouts, e ficheiros
     * legítimos que necessitam de CSS embutido (emails, relatórios PDF, vendor).
     */
    public function test_ui_views_contain_no_inline_scripts_or_styles(): void
    {
        $viewsDir = resource_path('views');
        $excluded = ['emails', 'reports', 'vendor'];

        $violations = [];

        foreach (File::allFiles($viewsDir) as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $relativePath = str_replace('\\', '/', $file->getRelativePathname());
            foreach ($excluded as $prefix) {
                if (str_starts_with($relativePath, $prefix . '/')) {
                    continue 2;
                }
            }

            $content = $file->getContents();

            if (preg_match('/<style[\s>]/i', $content)) {
                $violations[] = "$relativePath contains an inline <style> tag";
            }

            if (preg_match_all('/<script(?![^>]*\bsrc=)[^>]*>(.*?)<\/script>/is', $content, $matches)) {
                foreach ($matches[1] as $inline) {
                    $isFoucInit = str_contains($inline, 'prefers-color-scheme')
                        && str_contains($inline, "localStorage.getItem('theme')");

                    if (! $isFoucInit) {
                        $violations[] = "$relativePath contains an inline <script> tag";
                    }
                }
            }
        }

        $this->assertSame([], $violations, implode(PHP_EOL, $violations));
    }

    /**
     * Todos os page keys usados pelas views devem estar registados no
     * page-registry para que o módulo da página arranque (ex.: users-create).
     */
    public function test_every_page_key_is_registered_for_bootstrap(): void
    {
        $registry = File::get(resource_path('js/bootstrap/page-registry.js'));
        $viewsDir = resource_path('views');

        $keys = [];

        foreach (File::allFiles($viewsDir) as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $content = $file->getContents();
            if (preg_match_all("/@section\('page_key',\s*'([^']+)'\)/", $content, $matches)) {
                foreach ($matches[1] as $key) {
                    $keys[] = $key;
                }
            }
        }

        $keys = array_values(array_unique($keys));

        // Extrai chaves registadas (quoted e unquoted) do objeto pageRegistry
        preg_match_all('/^\s*(?:\'([^\']+)\'|([\w-]+))\s*:/m', $registry, $matches);
        $registered = array_values(array_unique(array_filter(array_merge($matches[1], $matches[2]))));

        foreach ($keys as $key) {
            $this->assertTrue(
                in_array($key, $registered, true),
                "Page key '{$key}' is used by a view but is not registered in resources/js/bootstrap/page-registry.js"
            );
        }

        $this->assertNotEmpty($keys);
    }

    /**
     * O Alpine.js tem de estar no bundle e os componentes x-data registados,
     * caso contrário as views com x-data deixam de funcionar.
     */
    public function test_alpine_is_bundled_in_built_assets(): void
    {
        $manifestPath = public_path('build/manifest.json');

        if (!File::exists($manifestPath)) {
            $this->markTestSkipped('Vite manifest not built. Run `npm run build`.');
        }

        $manifest = json_decode(File::get($manifestPath), true);
        $entry = $manifest['resources/js/app.js'] ?? null;

        $this->assertNotNull($entry, 'Manifest is missing the resources/js/app.js entry');

        $assetPath = public_path('build/' . $entry['file']);
        $this->assertFileExists($assetPath);

        $bundle = File::get($assetPath);

        $this->assertStringContainsString('Alpine', $bundle);
        $this->assertStringContainsString('comboboxComponent', $bundle);
        $this->assertStringContainsString('autocompleteComponent', $bundle);
        $this->assertStringContainsString('users-create', $bundle);

        $packageJson = json_decode(File::get(base_path('package.json')), true);
        $this->assertArrayHasKey('alpinejs', $packageJson['dependencies'] ?? $packageJson['devDependencies'] ?? []);
    }

    /**
     * As páginas autenticadas da UI devem renderizar o data-page correto
     * (para o boot do módulo) e sem resíduos de scripts inline.
     */
    public function test_authenticated_ui_pages_render_page_keys_without_inline_scripts(): void
    {
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);

        $admin = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $dashboard = $this->withHeader('X-Auth-Token', $admin->api_token)->get('/ui');
        $dashboard->assertOk();
        $dashboard->assertSee('data-page="dashboard"', false);
        $this->assertNoUnsanctionedInlineScripts($dashboard->getContent(), '/ui');
        $this->assertStringContainsString('prefers-color-scheme', $dashboard->getContent());

        $create = $this->withHeader('X-Auth-Token', $admin->api_token)->get('/ui/users/create');
        $create->assertOk();
        $create->assertSee('data-page="users-create"', false);
        $this->assertNoUnsanctionedInlineScripts($create->getContent(), '/ui/users/create');

        $edit = $this->withHeader('X-Auth-Token', $admin->api_token)->get('/ui/users/' . $admin->id . '/edit');
        $edit->assertOk();
        $edit->assertSee('data-page="users-edit"', false);
        $this->assertNoUnsanctionedInlineScripts($edit->getContent(), '/ui/users/{id}/edit');

        $profile = $this->withHeader('X-Auth-Token', $admin->api_token)->get('/ui/profile');
        $profile->assertOk();
        $profile->assertSee('data-page="profile"', false);
        $this->assertNoUnsanctionedInlineScripts($profile->getContent(), '/ui/profile');
    }

    private function assertNoUnsanctionedInlineScripts(string $content, string $context): void
    {
        preg_match_all('/<script(?![^>]*\bsrc=)[^>]*>(.*?)<\/script>/is', $content, $matches);

        foreach ($matches[1] as $inline) {
            $isFoucInit = str_contains($inline, 'prefers-color-scheme')
                && str_contains($inline, "localStorage.getItem('theme')");

            $this->assertTrue(
                $isFoucInit,
                "$context contains an unsanctioned inline <script> tag"
            );
        }
    }

    /**
     * O layout principal deve incluir o script síncrono anti-FOUC no <head>,
     * para que o tema (dark/light) seja aplicado antes da primeira pintura.
     */
    public function test_layouts_include_synchronous_anti_fouc_theme_script(): void
    {
        foreach (['ui/layout.blade.php', 'layouts/layout.blade.php', 'ui/auth.blade.php'] as $view) {
            $path = resource_path('views/' . $view);
            $content = File::get($path);

            $this->assertStringContainsString('prefers-color-scheme', $content);
            $this->assertStringContainsString("localStorage.getItem('theme')", $content);

            $head = strstr($content, '</head>', true);
            $this->assertStringContainsString('localStorage', $head);
        }
    }

    /**
     * As views e JS não podem conter escapes unicode literais (ex.: \u00e9)
     * que são apresentados ao utilizador como texto cru ("T\u00e9cnico").
     */
    public function test_views_and_js_contain_no_literal_unicode_escapes(): void
    {
        $violations = [];

        foreach (File::allFiles(resource_path('views')) as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }
            $relativePath = str_replace('\\', '/', $file->getRelativePathname());
            if (str_starts_with($relativePath, 'vendor/')) {
                continue;
            }
            if (preg_match('/\\\\u[0-9a-fA-F]{4}/', $file->getContents())) {
                $violations[] = $relativePath;
            }
        }

        foreach (File::allFiles(resource_path('js')) as $file) {
            if ($file->getExtension() !== 'js') {
                continue;
            }
            $relativePath = str_replace('\\', '/', $file->getRelativePathname());
            if (preg_match('/\\\\u[0-9a-fA-F]{4}/', $file->getContents())) {
                $violations[] = $relativePath;
            }
        }

        $this->assertSame([], $violations, implode(PHP_EOL, $violations));
    }
}
