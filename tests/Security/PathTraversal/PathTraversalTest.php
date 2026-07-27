<?php

namespace Tests\Security\PathTraversal;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\ApiTestCase;

class PathTraversalTest extends ApiTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function it_prevents_path_traversal_in_file_upload(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => \Illuminate\Http\UploadedFile::fake()->create('../../../etc/passwd', 100),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_prevents_path_traversal_in_ticket_id(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $response = $this->withApiUser('user-token')
            ->getJson('/tickets/../../../etc/passwd');

        $response->assertNotFound();
    }

    #[Test]
    public function it_prevents_path_traversal_in_comment_id(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('user-token')
            ->getJson("/tickets/{$ticket->id}/comments/../../admin/users");

        $response->assertNotFound();
    }

    #[Test]
    public function it_sanitizes_directory_traversal_in_filenames(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id,
            'api_token' => 'tech-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->withApiUser('tech-token')
            ->post('/tickets/'.$ticket->id.'/photos', [
                'photo' => \Illuminate\Http\UploadedFile::fake()->create('test/../../malicious.jpg', 100),
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }

    #[Test]
    public function it_prevents_url_encoded_path_traversal(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'user-token',
            'active' => true,
        ]);

        $response = $this->withApiUser('user-token')
            ->getJson('/tickets/%2e%2e%2f%2e%2e%2f%2e%2e%2fetc%2fpasswd');

        $response->assertNotFound();
    }
}
