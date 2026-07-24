<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseSchemaValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate', ['--force' => true]);
    }

    private function getTableColumns(string $table): array
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            $results = DB::select("PRAGMA table_info({$table})");

            return array_map(fn ($col) => $col->name, $results);
        }

        return Schema::getColumnListing($table);
    }

    private function getTableIndexes(string $table): array
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            $results = DB::select("PRAGMA index_list({$table})");
            $indexes = [];

            foreach ($results as $row) {
                $indexInfo = DB::select("PRAGMA index_info({$row->name})");
                $columns = array_map(fn ($col) => $col->name, $indexInfo);
                $indexes[$row->name] = [
                    'unique' => (bool) $row->unique,
                    'columns' => $columns,
                ];
            }

            return $indexes;
        }

        $indexes = [];
        $results = DB::select("SHOW INDEX FROM {$table}");
        foreach ($results as $row) {
            $name = $row->Key_name;
            if (! isset($indexes[$name])) {
                $indexes[$name] = ['unique' => ! $row->Non_unique, 'columns' => []];
            }
            $indexes[$name]['columns'][] = $row->Column_name;
        }

        return $indexes;
    }

    public function test_all_expected_tables_exist(): void
    {
        $expectedTables = [
            'users', 'user_profiles', 'tickets', 'ticket_statuses', 'ticket_types',
            'ticket_comments', 'ticket_attachments', 'ticket_workflow_history',
            'rooms', 'equipments', 'equipment_categories', 'audits', 'notifications',
        ];

        $existingTables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        $tableNames = array_map(fn ($t) => $t->name, $existingTables);

        foreach ($expectedTables as $table) {
            $this->assertContains($table, $tableNames, "Table '$table' is missing from the database");
        }
    }

    public function test_tickets_table_has_required_columns(): void
    {
        $columns = $this->getTableColumns('tickets');

        $required = ['id', 'title', 'description', 'user_id', 'status_id', 'priority',
            'equipment_id', 'room_id', 'assigned_to', 'opened_at', 'closed_at',
            'created_at', 'updated_at', 'deleted_at'];

        foreach ($required as $col) {
            $this->assertContains($col, $columns, "Column '$col' missing from tickets table");
        }
    }

    public function test_users_table_has_required_columns(): void
    {
        $columns = $this->getTableColumns('users');

        $required = ['id', 'name', 'email', 'password', 'profile_id', 'active',
            'api_token', 'created_at', 'updated_at'];

        foreach ($required as $col) {
            $this->assertContains($col, $columns, "Column '$col' missing from users table");
        }
    }

    public function test_rooms_table_has_soft_deletes(): void
    {
        $columns = $this->getTableColumns('rooms');
        $this->assertContains('deleted_at', $columns, 'rooms table missing deleted_at column');
    }

    public function test_tickets_table_has_soft_deletes(): void
    {
        $columns = $this->getTableColumns('tickets');
        $this->assertContains('deleted_at', $columns, 'tickets table missing deleted_at column');
    }

    public function test_equipments_table_has_soft_deletes(): void
    {
        $columns = $this->getTableColumns('equipments');
        $this->assertContains('deleted_at', $columns, 'equipments table missing deleted_at column');
    }

    public function test_unique_constraints_enforced(): void
    {
        $indexes = $this->getTableIndexes('users');

        $found = false;
        foreach ($indexes as $name => $index) {
            if ($index['unique'] && in_array('email', $index['columns'])) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, 'users.email unique constraint missing');
    }

    public function test_equipments_serial_is_unique(): void
    {
        $indexes = $this->getTableIndexes('equipments');

        $found = false;
        foreach ($indexes as $name => $index) {
            if ($index['unique'] && in_array('serial', $index['columns'])) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, 'equipments.serial unique constraint missing');
    }

    public function test_ticket_statuses_name_is_unique(): void
    {
        $indexes = $this->getTableIndexes('ticket_statuses');

        $found = false;
        foreach ($indexes as $name => $index) {
            if ($index['unique'] && in_array('name', $index['columns'])) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, 'ticket_statuses.name unique constraint missing');
    }

    public function test_tickets_has_indexes_on_status_and_priority(): void
    {
        $indexes = $this->getTableIndexes('tickets');
        $allIndexColumns = [];

        foreach ($indexes as $index) {
            $allIndexColumns[] = $index['columns'];
        }

        $hasStatusIndex = ! empty(array_filter($allIndexColumns, fn ($cols) => in_array('status_id', $cols)));
        $hasPriorityIndex = ! empty(array_filter($allIndexColumns, fn ($cols) => in_array('priority', $cols)));

        $this->assertTrue($hasStatusIndex, 'tickets table missing index on status_id');
        $this->assertTrue($hasPriorityIndex, 'tickets table missing index on priority');
    }

    public function test_notifications_has_user_id_index(): void
    {
        $indexes = $this->getTableIndexes('notifications');
        $allIndexColumns = [];

        foreach ($indexes as $index) {
            $allIndexColumns[] = $index['columns'];
        }

        $hasUserIndex = ! empty(array_filter($allIndexColumns, fn ($cols) => in_array('user_id', $cols)));
        $this->assertTrue($hasUserIndex, 'notifications table missing index on user_id');
    }
}
