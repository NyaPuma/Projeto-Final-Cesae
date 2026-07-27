<?php

namespace Tests\Security\FileUpload;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\ApiTestCase;

class FileUploadSecurityTest extends ApiTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function it_rejects_executable_files(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('malicious.exe', 100, 'application/x-msdownload'),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_rejects_php_files(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('shell.php', 100, 'application/x-php'),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_limits_file_size(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('huge.jpg', 10240 * 1024), // 10MB
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_validates_mime_type(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('fake.jpg', 100, 'text/plain'),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_accepts_valid_image_files(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->image('test.jpg', 400, 300),
            ], ['Accept' => 'application/json']);

        $response->assertCreated();
    }

    #[Test]
    public function it_sanitizes_filenames(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->image('test with spaces.jpg', 400, 300),
            ], ['Accept' => 'application/json']);

        $response->assertCreated();
        $filename = $response->json('attachment.file_name');
        $this->assertStringNotContainsString(' ', $filename);
    }

    #[Test]
    public function it_requires_authentication_for_upload(): void
    {
        $ticket = \App\Models\Ticket::factory()->create();

        $response = $this->post('/tickets/'.$ticket->id.'/photos', [
            'photo' => UploadedFile::fake()->image('test.jpg', 400, 300),
        ], ['Accept' => 'application/json']);

        $response->assertUnauthorized();
    }
}
