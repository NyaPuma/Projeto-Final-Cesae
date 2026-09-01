<?php

namespace Tests\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Assert as PHPUnit;

trait InteractsWithStorage
{
    protected function fakeStorage(string $disk = 'public'): void
    {
        Storage::fake($disk);
    }

    protected function createImageFile(string $name = 'test.jpg', int $size = 1024): UploadedFile
    {
        return UploadedFile::fake()->image($name, $size);
    }

    protected function createPdfFile(string $name = 'test.pdf', int $size = 1024): UploadedFile
    {
        return UploadedFile::fake()->create($name, $size, 'application/pdf');
    }

    protected function createDocumentFile(string $name = 'test.doc', int $size = 1024): UploadedFile
    {
        return UploadedFile::fake()->create($name, $size, 'application/msword');
    }

    protected function assertFileExistsInStorage(string $disk, string $path): void
    {
        PHPUnit::assertTrue(Storage::disk($disk)->exists($path), "Failed asserting that file [{$path}] exists on disk [{$disk}].");
    }

    protected function assertFileMissingInStorage(string $disk, string $path): void
    {
        PHPUnit::assertFalse(Storage::disk($disk)->exists($path), "Failed asserting that file [{$path}] is missing on disk [{$disk}].");
    }

    protected function assertDirectoryExistsInStorage(string $disk, string $path): void
    {
        PHPUnit::assertTrue(Storage::disk($disk)->exists($path), "Failed asserting that directory [{$path}] exists on disk [{$disk}].");
    }

    protected function assertDirectoryMissingInStorage(string $disk, string $path): void
    {
        PHPUnit::assertFalse(Storage::disk($disk)->exists($path), "Failed asserting that directory [{$path}] is missing on disk [{$disk}].");
    }
}
