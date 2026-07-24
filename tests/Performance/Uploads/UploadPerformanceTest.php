<?php

namespace Tests\Performance\Uploads;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Performance\PerformanceTestCase;

class UploadPerformanceTest extends PerformanceTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_small_file_upload_performance(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $file = UploadedFile::fake()->image('photo.jpg', 100, 100)->size(50);

        $this->asUser();
        $this->startQueryLog();

        $time = $this->measureTime(function () use ($tickets, $file) {
            $this->postJson('/tickets/'.$tickets[0]->id.'/photos', [
                'photo' => $file,
            ])->assertStatus(201);
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(300, $time,
            "Small file upload (50KB) took {$time}ms");
        $this->assertLessThanOrEqual(10, count($queries));
    }

    public function test_medium_file_upload_performance(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $file = UploadedFile::fake()->image('photo.jpg', 800, 600)->size(500);

        $this->asUser();

        $time = $this->measureTime(function () use ($tickets, $file) {
            $this->postJson('/tickets/'.$tickets[0]->id.'/photos', [
                'photo' => $file,
            ])->assertStatus(201);
        });

        $this->assertLessThanOrEqual(500, $time,
            "Medium file upload (500KB) took {$time}ms");
    }

    public function test_large_file_upload_performance(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $file = UploadedFile::fake()->image('photo.jpg', 1920, 1080)->size(2048);

        $this->asUser();

        $time = $this->measureTime(function () use ($tickets, $file) {
            $this->postJson('/tickets/'.$tickets[0]->id.'/photos', [
                'photo' => $file,
            ])->assertStatus(201);
        });

        $this->assertLessThanOrEqual(1000, $time,
            "Large file upload (2MB) took {$time}ms");
    }

    public function test_upload_memory_usage(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $file = UploadedFile::fake()->image('photo.jpg', 800, 600)->size(500);

        $this->asUser();

        $memory = $this->measureMemory(function () use ($tickets, $file) {
            $this->postJson('/tickets/'.$tickets[0]->id.'/photos', [
                'photo' => $file,
            ])->assertStatus(201);
        });

        $this->assertLessThanOrEqual(200 * 1024 * 1024, $memory['peak'],
            "Upload peak memory: ".round($memory['peak'] / 1024 / 1024, 2).'MB');
    }

    public function test_multiple_uploads_memory_stability(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $this->asUser();

        gc_collect_cycles();
        $initialMemory = memory_get_usage(true);

        for ($i = 0; $i < 10; $i++) {
            $file = UploadedFile::fake()->image("photo_{$i}.jpg", 400, 300)->size(100);
            $this->postJson('/tickets/'.$tickets[0]->id.'/photos', [
                'photo' => $file,
            ])->assertStatus(201);
        }

        gc_collect_cycles();
        $finalMemory = memory_get_usage(true);
        $growth = $finalMemory - $initialMemory;

        $this->assertLessThanOrEqual(20 * 1024 * 1024, $growth,
            "Memory grew by ".round($growth / 1024 / 1024, 2).'MB after 10 uploads');
    }

    public function test_upload_list_photos_performance(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $this->asUser();

        for ($i = 0; $i < 20; $i++) {
            $file = UploadedFile::fake()->image("photo_{$i}.jpg", 400, 300)->size(100);
            $this->postJson('/tickets/'.$tickets[0]->id.'/photos', ['photo' => $file]);
        }

        $time = $this->measureTime(function () use ($tickets) {
            $this->getJson('/tickets/'.$tickets[0]->id.'/photos')->assertOk();
        });

        $this->assertLessThanOrEqual(300, $time,
            "Listing 20 photos took {$time}ms");
    }

    public function test_photo_delete_performance(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $this->asUser();

        $file = UploadedFile::fake()->image('photo.jpg', 400, 300)->size(100);
        $response = $this->postJson('/tickets/'.$tickets[0]->id.'/photos', ['photo' => $file])
            ->json();

        $photoId = $response['attachment']['id'];

        $time = $this->measureTime(function () use ($tickets, $photoId) {
            $this->deleteJson('/tickets/'.$tickets[0]->id.'/photos/'.$photoId)->assertOk();
        });

        $this->assertLessThanOrEqual(300, $time,
            "Photo delete took {$time}ms");
    }
}
