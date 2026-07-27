<?php

namespace Tests\Fixtures\Helpers;

use Illuminate\Support\Str;

class TestHelper
{
    public static function randomEmail(): string
    {
        return 'test_'.Str::random(10).'@example.com';
    }

    public static function randomName(): string
    {
        return 'Test User '.Str::random(5);
    }

    public static function randomToken(): string
    {
        return Str::random(60);
    }

    public static function randomPassword(): string
    {
        return 'Password'.Str::random(8).'!';
    }

    public static function futureDate(int $days = 1): string
    {
        return now()->addDays($days)->toDateTimeString();
    }

    public static function pastDate(int $days = 1): string
    {
        return now()->subDays($days)->toDateTimeString();
    }

    public static function randomPhoneNumber(): string
    {
        return '+351'.rand(900000000, 999999999);
    }

    public static function randomUrl(): string
    {
        return 'https://example.com/'.Str::random(10);
    }
}
