<?php

namespace Tests\Integration\Database;


use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class MassAssignmentProtectionTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function it_prevents_mass_assignment_of_id(): void
    {
        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Mass Assign Test',
            'description' => 'Testing mass assignment',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $originalTicket = Ticket::find($ticketId);

        $response = $this->patchJson("/tickets/{$ticketId}/comments", [
            'comment' => 'Testing',
        ]);

        $this->assertDatabaseHas('tickets', ['id' => $ticketId]);
    }

    #[Test]
    public function it_prevents_mass_assignment_of_api_token(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        $response = $this->postJson('/admin/users', [
            'name' => 'Mass Test',
            'email' => 'mass.'.uniqid().'@example.invalid',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => UserRoleEnum::User->value,
            'profile_id' => $profile->id,
        ]);
        $response->assertStatus(201);
        $newUserId = $response->json('user.id');

        $user = User::find($newUserId);
        $this->assertNotEquals('Password123!456', $user->api_token);
    }
}
