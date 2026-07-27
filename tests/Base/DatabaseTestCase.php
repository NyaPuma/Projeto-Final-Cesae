<?php

namespace Tests\Base;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class DatabaseTestCase extends BaseTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createViteManifest();
    }

    protected function assertDatabaseHasTable(string $table): void
    {
        $this->assertTrue(
            \Schema::hasTable($table),
            "Database table '{$table}' does not exist."
        );
    }

    protected function assertDatabaseMissingTable(string $table): void
    {
        $this->assertFalse(
            \Schema::hasTable($table),
            "Database table '{$table}' exists but should not."
        );
    }

    protected function assertDatabaseHasColumn(string $table, string $column): void
    {
        $this->assertTrue(
            \Schema::hasColumn($table, $column),
            "Database table '{$table}' does not have column '{$column}'."
        );
    }

    protected function assertDatabaseMissingColumn(string $table, string $column): void
    {
        $this->assertFalse(
            \Schema::hasColumn($table, $column),
            "Database table '{$table}' has column '{$column}' but should not."
        );
    }

    protected function assertDatabaseHasIndex(string $table, string $index): void
    {
        $this->assertTrue(
            \Schema::hasIndex($table, $index),
            "Database table '{$table}' does not have index '{$index}'."
        );
    }

    protected function assertDatabaseMissingIndex(string $table, string $index): void
    {
        $this->assertFalse(
            \Schema::hasIndex($table, $index),
            "Database table '{$table}' has index '{$index}' but should not."
        );
    }

    protected function assertDatabaseHasForeignKey(string $table, string $foreign): void
    {
        $this->assertTrue(
            \Schema::hasForeignKey($table, $foreign),
            "Database table '{$table}' does not have foreign key '{$foreign}'."
        );
    }

    protected function assertDatabaseMissingForeignKey(string $table, string $foreign): void
    {
        $this->assertFalse(
            \Schema::hasForeignKey($table, $foreign),
            "Database table '{$table}' has foreign key '{$foreign}' but should not."
        );
    }

    private function createViteManifest(): void
    {
        $buildDir = public_path('build');
        $manifest = $buildDir.'/manifest.json';

        @mkdir($buildDir, 0755, true);

        $existing = [];
        if (file_exists($manifest)) {
            $existing = json_decode(file_get_contents($manifest), true) ?: [];
        }

        $stub = $existing + [
            'resources/css/app.css' => [
                'file' => 'assets/app.css',
                'name' => 'app',
                'names' => ['app.css'],
                'src' => 'resources/css/app.css',
                'isEntry' => true,
            ],
            'resources/js/app.js' => [
                'file' => 'assets/app.js',
                'name' => 'app',
                'src' => 'resources/js/app.js',
                'isEntry' => true,
                'dynamicImports' => [
                    'resources/js/pages/auth.js',
                    'resources/js/pages/equipments.js',
                    'resources/js/pages/rooms.js',
                ],
            ],
            'resources/js/pages/auth.js' => [
                'file' => 'assets/auth.js',
                'name' => 'auth',
                'src' => 'resources/js/pages/auth.js',
                'isDynamicEntry' => true,
            ],
            'resources/js/pages/equipments.js' => [
                'file' => 'assets/equipments.js',
                'name' => 'equipments',
                'src' => 'resources/js/pages/equipments.js',
                'isDynamicEntry' => true,
            ],
            'resources/js/pages/rooms.js' => [
                'file' => 'assets/rooms.js',
                'name' => 'rooms',
                'src' => 'resources/js/pages/rooms.js',
                'isDynamicEntry' => true,
            ],
            'resources/css/swagger/swagger.css' => [
                'file' => 'assets/swagger.css',
                'name' => 'swagger',
                'src' => 'resources/css/swagger/swagger.css',
                'isEntry' => true,
            ],
            'resources/js/swagger/utils.js' => [
                'file' => 'assets/swagger-utils.js',
                'name' => 'swagger-utils',
                'src' => 'resources/js/swagger/utils.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/search.js' => [
                'file' => 'assets/swagger-search.js',
                'name' => 'swagger-search',
                'src' => 'resources/js/swagger/search.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/badges.js' => [
                'file' => 'assets/swagger-badges.js',
                'name' => 'swagger-badges',
                'src' => 'resources/js/swagger/badges.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/counters.js' => [
                'file' => 'assets/swagger-counters.js',
                'name' => 'swagger-counters',
                'src' => 'resources/js/swagger/counters.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/expand.js' => [
                'file' => 'assets/swagger-expand.js',
                'name' => 'swagger-expand',
                'src' => 'resources/js/swagger/expand.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/scrollspy.js' => [
                'file' => 'assets/swagger-scrollspy.js',
                'name' => 'swagger-scrollspy',
                'src' => 'resources/js/swagger/scrollspy.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/toolbar.js' => [
                'file' => 'assets/swagger-toolbar.js',
                'name' => 'swagger-toolbar',
                'src' => 'resources/js/swagger/toolbar.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/sidebar.js' => [
                'file' => 'assets/swagger-sidebar.js',
                'name' => 'swagger-sidebar',
                'src' => 'resources/js/swagger/sidebar.js',
                'isEntry' => true,
            ],
            'resources/js/swagger/init.js' => [
                'file' => 'assets/swagger-init.js',
                'name' => 'swagger-init',
                'src' => 'resources/js/swagger/init.js',
                'isEntry' => true,
            ],
        ];

        file_put_contents($manifest, json_encode($stub, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
