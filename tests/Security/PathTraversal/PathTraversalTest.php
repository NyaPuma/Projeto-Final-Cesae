<?php

namespace Tests\Security\PathTraversal;

use App\Models\Ticket;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class PathTraversalTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function it_prevents_path_traversal_in_file_upload(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('../../../etc/passwd', 100),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_prevents_path_traversal_in_ticket_id(): void
    {
        $user = $this->createRegularUser();
        $response = $this->asApiUser($user->api_token)
            ->getJson('/tickets/../../../etc/passwd');

        $response->assertNotFound();
    }

    #[Test]
    public function it_prevents_path_traversal_in_comment_id(): void
    {
        $user = $this->createRegularUser();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->getJson("/tickets/{$ticket->id}/comments/../../admin/users");

        $response->assertNotFound();
    }

    #[Test]
    public function it_sanitizes_directory_traversal_in_filenames(): void
    {
        $user = $this->createTechnician();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $response = $this->asApiUser($user->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->create('test/../../malicious.jpg', 100),
            ], ['Accept' => 'application/json']);

        $response->assertCreated();
    }

    #[Test]
    public function it_prevents_url_encoded_path_traversal(): void
    {
        $user = $this->createRegularUser();
        $response = $this->asApiUser($user->api_token)
            ->getJson('/tickets/%2e%2e%2f%2e%2e%2f%2e%2e%2fetc%2fpasswd');

        $response->assertNotFound();
    }
}
