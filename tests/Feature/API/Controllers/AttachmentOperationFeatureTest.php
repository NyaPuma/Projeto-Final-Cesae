<?php

namespace Tests\Feature\API\Controllers;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
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
            ->deleteJson("/api/tickets/{$ticket->id}/photos/{$attachment->id}");

        $response->assertOk();
        $this->assertSoftDeleted($attachment);
        $this->assertFalse(Storage::disk('public')->exists($path));
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
            ->deleteJson("/api/tickets/{$ticket->id}/photos/{$attachment->id}");

        $response->assertOk();
        $this->assertSoftDeleted($attachment);
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
            ->deleteJson("/api/tickets/{$ticket->id}/photos/{$attachment->id}");

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
            ->deleteJson("/api/tickets/{$ticket->id}/photos/99999");

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
            ->getJson("/api/tickets/{$ticket->id}/photos");

        $response->assertOk()
            ->assertJsonStructure(['attachments' => [
                '*' => ['id', 'file_name', 'path', 'mime_type', 'size', 'ticket_id', 'user_id'],
            ]]);
        $this->assertCount(2, $response->json('attachments'));
    }

    public function test_upload_persists_disk_extension_and_original_name(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Persist metadata',
            'description' => 'Testing persisted upload metadata',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->image('minha-foto.jpg', 640, 480),
            ]);

        $response->assertStatus(201);
        $this->assertStringStartsWith('ticket_photos/', $response->json('attachment.path'));
        $this->assertSame('public', $response->json('attachment.disk'));
        $this->assertSame('jpg', $response->json('attachment.extension'));
        $this->assertSame('minha-foto.jpg', $response->json('attachment.original_name'));
        $this->assertSame('image/jpeg', $response->json('attachment.mime_type'));

        $this->assertTrue(Storage::disk('public')->exists($response->json('attachment.path')));
        $this->assertDatabaseHas('ticket_attachments', [
            'ticket_id' => $ticket->id,
            'disk' => 'public',
            'extension' => 'jpg',
            'original_name' => 'minha-foto.jpg',
        ]);
    }

    public function test_upload_derives_extension_from_real_mime_not_client_extension(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Canonical extension',
            'description' => 'Stored extension must come from the real mime mapping, not the client extension string',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->image('photo.jpeg', 320, 240),
            ]);

        $response->assertStatus(201);
        $file = $response->json('attachment.file_name');
        $this->assertStringEndsWith('.jpg', $file);
        $this->assertStringNotContainsString('.jpeg', $file);
        $this->assertSame('jpg', $response->json('attachment.extension'));
    }

    public function test_upload_rejects_php_extension_even_with_valid_image(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Php extension blocked',
            'description' => 'A valid image named with a php extension must be rejected',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->image('shell.php', 320, 240),
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['photo']]);
    }

    public function test_model_delete_removes_physical_file_on_public_disk(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Model disk fallback',
            'description' => 'Legacy attachment without disk column must fall back to public disk',
            'priority' => TicketPriorityEnum::Low->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $photo = UploadedFile::fake()->create('legacy.jpg', 10, 'image/jpeg');
        $path = $photo->store('ticket_photos', 'public');

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => 'legacy.jpg',
            'path' => $path,
            'mime_type' => 'image/jpeg',
            'size' => 1024,
        ]);

        $this->assertTrue(Storage::disk('public')->exists($path));

        $attachment->delete();

        $this->assertSoftDeleted($attachment);
        $this->assertFalse(Storage::disk('public')->exists($path));
    }
}
