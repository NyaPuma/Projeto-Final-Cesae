<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuditTest extends TestCase
{
    use RefreshDatabase;

    public function test_audit_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $audit = Audit::create([
            'user_id' => $user->id,
            'auditable_type' => 'App\Models\Ticket',
            'auditable_id' => 1,
            'event' => 'updated',
            'old_values' => ['status_id' => 1],
            'new_values' => ['status_id' => 2],
            'url' => 'http://localhost/tickets/1',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit',
        ]);

        $this->assertInstanceOf(User::class, $audit->user);
        $this->assertEquals($user->id, $audit->user->id);
    }

    public function test_audit_casts_old_and_new_values_to_array()
    {
        $audit = Audit::create([
            'auditable_type' => 'App\Models\Ticket',
            'auditable_id' => 1,
            'event' => 'created',
            'old_values' => null,
            'new_values' => ['title' => 'Test Ticket'],
        ]);

        $this->assertIsArray($audit->new_values);
        $this->assertEquals('Test Ticket', $audit->new_values['title']);
    }
}
