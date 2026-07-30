<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketPhotoUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar perfis necessÃ¡rios para os testes
        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);

        // Criar estados de ticket
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    private function createUserWithToken(string $profileName): User
    {
        $profile = UserProfile::where('name', $profileName)->firstOrFail();

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
        ]);
    }

    public function test_ticket_photo_can_be_uploaded(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Avaria teste',
            'description' => 'DescriÃ§Ã£o da avaria',
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('damage.jpg', 100, 'image/jpeg'),
            ]);

        $response->assertStatus(201);
        $response->assertJsonPath('attachment.file_name', 'damage.jpg');
        $this->assertStringStartsWith('ticket_photos/', $response->json('attachment.path'));
        $this->assertDatabaseHas('ticket_attachments', [
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_ticket_photo_upload_requires_photo_field(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Avaria teste',
            'description' => 'DescriÃ§Ã£o da avaria',
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets/'.$ticket->id.'/photos', [
                // sem photo
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['photo']]);
    }

    public function test_ticket_photo_upload_rejects_non_image_file(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Avaria teste',
            'description' => 'DescriÃ§Ã£o da avaria',
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('damage.txt', 10, 'text/plain'),
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['photo']]);
    }

    public function test_ticket_photo_upload_rejects_when_ticket_does_not_exist(): void
    {
        Storage::fake('public');

        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets/999999/photos', [
                'photo' => UploadedFile::fake()->create('damage.jpg', 10, 'image/jpeg'),
            ]);

        $response->assertStatus(404);
        $response->assertJsonIsObject();
    }
}
