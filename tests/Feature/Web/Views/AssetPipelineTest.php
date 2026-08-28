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
     * UI views must not contain inline CSS or JS.
     * Allowed: <script src="..."> (CDN/external), the synchronous FOUC
     * prevention block (dark/light theme) in layout <head>, and legitimate
     * files that need embedded CSS (emails, PDF reports, vendor).
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
     * All page keys used by views must be registered in the
     * page-registry for the page module to bootstrap (e.g., users-create).
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

        // Extract registered keys (quoted and unquoted) from the pageRegistry object
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
     * Alpine.js must be in the bundle and x-data components registered,
     * otherwise views with x-data stop working.
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
     * Authenticated UI pages must render the correct data-page
     * (for module bootstrap) and without inline script remnants.
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
     * The main layout must include the synchronous anti-FOUC script in <head>,
     * so the theme (dark/light) is applied before the first paint.
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
     * Views and JS must not contain literal unicode escapes (e.g., \u00e9)
     * that are rendered to the user as raw text ("T\u00e9cnico").
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
