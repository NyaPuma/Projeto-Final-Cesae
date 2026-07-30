<?php

namespace Tests\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        Storage::disk($disk)->assertExists($path);
    }

    protected function assertFileMissingInStorage(string $disk, string $path): void
    {
        Storage::disk($disk)->assertMissing($path);
    }

    protected function assertDirectoryExistsInStorage(string $disk, string $path): void
    {
        Storage::disk($disk)->assertExists($path);
    }

    protected function assertDirectoryMissingInStorage(string $disk, string $path): void
    {
        Storage::disk($disk)->assertMissing($path);
    }
}
