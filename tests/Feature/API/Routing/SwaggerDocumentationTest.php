<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SwaggerDocumentationTest extends TestCase
{
    use RefreshDatabase;

    private function loadSpec(): array
    {
        return json_decode(
            file_get_contents(storage_path('api-docs/api-docs.json')),
            true,
            flags: JSON_THROW_ON_ERROR
        );
    }

    public function test_swagger_json_includes_protected_endpoints_and_security_schemes(): void
    {
        $spec = $this->loadSpec();

        $this->assertArrayHasKey('paths', $spec);
        $this->assertArrayHasKey('components', $spec);
        $this->assertArrayHasKey('securitySchemes', $spec['components']);
        $this->assertArrayHasKey('X-Auth-Token', $spec['components']['securitySchemes']);
        $this->assertArrayHasKey('BearerAuth', $spec['components']['securitySchemes']);

        $requiredPaths = [
            '/notifications',
            '/notifications/{id}',
            '/notifications/test-email',
            '/analytics/stats',
            '/analytics/export/csv',
            '/analytics/export/pdf',
            '/analytics/export/excel',
            '/admin/users',
            '/admin/equipment',
            '/admin/rooms',
            '/admin/audits',
            '/admin/preventive',
            '/stock/parts',
            '/stock/parts/{part}',
            '/stock/suppliers',
            '/stock/suppliers/{supplier}',
            '/stock/movements',
            '/stock/dashboard/summary',
            '/admin/parts',
            '/admin/suppliers',
            '/admin/tax-rates',
            '/admin/part-categories',
            '/admin/maintenance-plans',
        ];

        foreach ($requiredPaths as $path) {
            $this->assertArrayHasKey($path, $spec['paths'], "Missing Swagger path: {$path}");
        }

        foreach ([
            '/notifications',
            '/notifications/{id}',
            '/notifications/test-email',
            '/analytics/stats',
            '/analytics/export/csv',
            '/analytics/export/pdf',
            '/analytics/export/excel',
            '/admin/users',
            '/admin/equipment',
            '/admin/rooms',
            '/admin/audits',
            '/admin/preventive',
            '/stock/parts',
            '/stock/parts/{part}',
            '/stock/suppliers',
            '/stock/suppliers/{supplier}',
            '/stock/movements',
            '/stock/dashboard/summary',
            '/admin/parts',
            '/admin/suppliers',
            '/admin/tax-rates',
            '/admin/part-categories',
            '/admin/maintenance-plans',
        ] as $path) {
            foreach ($spec['paths'][$path] as $method => $operation) {
                $this->assertArrayHasKey('security', $operation, "Missing security block for {$method} {$path}");
                $this->assertNotEmpty($operation['security'], "Empty security block for {$method} {$path}");
            }
        }

        $this->assertArrayHasKey('/admin/equipment/{id}', $spec['paths']);
        $this->assertArrayHasKey('/admin/rooms/{id}', $spec['paths']);
        $this->assertArrayHasKey('/admin/rooms/{id}/inactive', $spec['paths']);
    }

    public function test_swagger_ui_route_requires_admin_authentication(): void
    {
        $this->withoutVite();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);

        // Sem autenticação: redirecionado para o login
        $this->get('/docs/openapi')->assertRedirect('/ui/login');

        // Utilizador comum / técnico: acesso negado
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->get('/docs/openapi')
            ->assertRedirect('/ui');

        // Admin: acesso permitido
        $admin = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->get('/docs/openapi')
            ->assertOk();
    }
}
