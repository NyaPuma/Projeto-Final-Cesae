<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class AttachmentOperationFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
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

    public function test_technician_can_delete_photo(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Photo delete test',
            'description' => 'Testing photo deletion',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $photo = UploadedFile::fake()->create('test-image.jpg', 10, 'image/jpeg');
        $path = $photo->store('ticket_photos', 'public');

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'test-image.jpg',
            'path' => $path,
            'mime_type' => 'image/jpeg',
            'size' => 1024,
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->deleteJson("/tickets/{$ticket->id}/photos/{$attachment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('ticket_attachments', ['id' => $attachment->id]);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_user_can_delete_own_photo(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Own photo delete test',
            'description' => 'Testing own photo deletion',
            'priority' => TicketPriorityEnum::Low->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $photo = UploadedFile::fake()->create('own-image.jpg', 10, 'image/jpeg');
        $path = $photo->store('ticket_photos', 'public');

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'own-image.jpg',
            'path' => $path,
            'mime_type' => 'image/jpeg',
            'size' => 2048,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->deleteJson("/tickets/{$ticket->id}/photos/{$attachment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('ticket_attachments', ['id' => $attachment->id]);
    }

    public function test_user_cannot_delete_another_users_photo(): void
    {
        Storage::fake('public');

        $user1 = $this->createUserWithToken(UserRoleEnum::User->value);
        $user2 = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user1->id,
            'title' => 'Unauthorized photo delete',
            'description' => 'Testing unauthorized deletion',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $photo = UploadedFile::fake()->create('unauthorized.jpg', 10, 'image/jpeg');
        $path = $photo->store('ticket_photos', 'public');

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user1->id,
            'file_name' => 'unauthorized.jpg',
            'path' => $path,
            'mime_type' => 'image/jpeg',
            'size' => 512,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user2->api_token)
            ->deleteJson("/tickets/{$ticket->id}/photos/{$attachment->id}");

        $response->assertStatus(403);
    }

    public function test_delete_nonexistent_photo_returns_404(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Nonexistent photo',
            'description' => 'Testing 404 on photo delete',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->deleteJson("/tickets/{$ticket->id}/photos/99999");

        $response->assertStatus(404);
    }

    public function test_list_photos_returns_correct_structure(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Photo list test',
            'description' => 'Testing photo listing',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $photo1 = UploadedFile::fake()->create('photo1.jpg', 10, 'image/jpeg');
        $photo2 = UploadedFile::fake()->create('photo2.jpg', 10, 'image/jpeg');

        TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'photo1.jpg',
            'path' => $photo1->store('ticket_photos', 'public'),
            'mime_type' => 'image/jpeg',
            'size' => 100,
        ]);

        TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'photo2.jpg',
            'path' => $photo2->store('ticket_photos', 'public'),
            'mime_type' => 'image/jpeg',
            'size' => 200,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson("/tickets/{$ticket->id}/photos");

        $response->assertOk()
            ->assertJsonStructure(['attachments' => [
                '*' => ['id', 'file_name', 'path', 'mime_type', 'size', 'ticket_id', 'user_id'],
            ]]);
        $this->assertCount(2, $response->json('attachments'));
    }
}
