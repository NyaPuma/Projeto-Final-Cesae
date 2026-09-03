<?php

namespace Tests\Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Database\Seeders\NotificationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NotificationSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_notification_seeder_runs_cleanly_across_dst_transition(): void
    {
        UserProfile::create(['name' => UserRoleEnum::User->value]);
        User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id]);

        // If any generated timestamp falls on a non-existent local time (DST gap,
        // e.g. 2026-03-29 01:xx in a local timezone), the MySQL session in the
        // pre-fix config would reject the insert. With `timezone => '+00:00'`
        // the session is UTC and the seeder must complete without throwing.
        $this->seed(NotificationSeeder::class);

        $this->assertEquals(600, DB::table('notifications')->count());

        $createdAtValues = DB::table('notifications')->pluck('created_at');
        $this->assertTrue(
            $createdAtValues->isNotEmpty(),
            'O seeder deve produzir notificações.',
        );
    }
}
