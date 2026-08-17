<?php

namespace Tests\Feature\Web\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\Room;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
    }

    private function createUserWithToken(string $profileName): User
    {
        $profile = UserProfile::where('name', $profileName)->firstOrFail();

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);
    }

    public function test_common_ui_pages_render(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        foreach (['/ui', '/ui/profile', '/ui/tickets', '/ui/tickets/create', '/ui/equipments', '/ui/rooms'] as $uri) {
            $this->withHeader('X-Auth-Token', $user->api_token)
                ->get($uri)
                ->assertOk();
        }
    }

    public function test_admin_ui_pages_render(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);

        foreach (['/ui/users', '/ui/users/create', '/ui/audits', '/ui/analytics'] as $uri) {
            $this->withHeader('X-Auth-Token', $admin->api_token)
                ->get($uri)
                ->assertOk();
        }
    }

    public function test_room_create_route_is_not_shadowed_by_show(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->get('/ui/rooms/create')
            ->assertOk()
            ->assertViewIs('ui.rooms.create');
    }

    public function test_room_show_and_edit_render(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $room = Room::create(['name' => 'Lab', 'location' => 'Piso 3', 'active' => true]);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->get("/ui/rooms/{$room->id}")
            ->assertOk()
            ->assertViewIs('ui.rooms.show');

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->get("/ui/rooms/{$room->id}/edit")
            ->assertOk()
            ->assertViewIs('ui.rooms.edit');
    }

    public function test_ticket_detail_renders(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->get('/ui/tickets/123')
            ->assertOk()
            ->assertViewIs('ui.ticket-detail');
    }

    public function test_user_edit_renders_with_target(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $target = $this->createUserWithToken(UserRoleEnum::User->value);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->get("/ui/users/{$target->id}/edit")
            ->assertOk()
            ->assertViewIs('ui.users-edit');
    }

    public function test_non_admin_cannot_access_admin_ui_pages(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        foreach (['/ui/users', '/ui/users/create', '/ui/audits', '/ui/analytics'] as $uri) {
            $this->withHeader('X-Auth-Token', $user->api_token)
                ->get($uri)
                ->assertRedirect('/ui');
        }
    }

    public function test_equipments_json_endpoint_lists_paginated(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/equipments')
            ->assertOk()
            ->assertJsonStructure(['equipments' => ['data' => []]]);
    }
}
