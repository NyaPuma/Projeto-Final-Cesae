<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\Notification;

trait InteractsWithNotifications
{
    protected function fakeNotifications(): void
    {
        Notification::fake();
    }

    protected function assertNotificationSent(mixed $notifiable, string $notification, ?callable $callback = null): void
    {
        Notification::assertSentTo($notifiable, $notification, $callback);
    }

    protected function assertNotificationSentTimes(mixed $notifiable, string $notification, int $times = 1): void
    {
        Notification::assertSentToTimes($notifiable, $notification, $times);
    }

    protected function assertNotificationNotSent(mixed $notifiable, string $notification): void
    {
        Notification::assertNotSentTo($notifiable, $notification);
    }

    protected function assertNothingSent(): void
    {
        Notification::assertNothingSent();
    }

    protected function assertNotificationCount(int $count): void
    {
        Notification::assertCount($count);
    }
}
