<?php

namespace Tests\Security\FileUpload;

use App\Models\Ticket;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class FileUploadSecurityTest extends FeatureTestCase
{
    use InteractsWithApi;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    #[Test]
    public function it_rejects_executable_files(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('malicious.exe', 100, 'application/x-msdownload'),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_rejects_php_files(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('shell.php', 100, 'application/x-php'),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_limits_file_size(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('huge.jpg', 10240 * 1024), // 10MB
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_validates_mime_type(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('fake.jpg', 100, 'text/plain'),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_accepts_valid_image_files(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->image('test.jpg', 400, 300),
            ], ['Accept' => 'application/json']);

        $response->assertCreated();
    }

    #[Test]
    public function it_sanitizes_filenames(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
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
        $ticket = Ticket::factory()->create();

        $response = $this->post('/tickets/'.$ticket->id.'/photos', [
            'photo' => UploadedFile::fake()->image('test.jpg', 400, 300),
        ], ['Accept' => 'application/json']);

        $response->assertUnauthorized();
    }
}
