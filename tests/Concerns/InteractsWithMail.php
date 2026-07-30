<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\Mail;

trait InteractsWithMail
{
    protected function fakeMail(): void
    {
        Mail::fake();
    }

    protected function assertMailSent(string $mailable, ?callable $callback = null): void
    {
        Mail::assertSent($mailable, $callback);
    }

    protected function assertMailSentTimes(string $mailable, int $times = 1): void
    {
        Mail::assertSentTimes($mailable, $times);
    }

    protected function assertMailNotSent(string $mailable): void
    {
        Mail::assertNotSent($mailable);
    }

    protected function assertNothingSent(): void
    {
        Mail::assertNothingSent();
    }

    protected function assertMailQueued(string $mailable, ?callable $callback = null): void
    {
        Mail::assertQueued($mailable, $callback);
    }

    protected function assertMailQueuedTimes(string $mailable, int $times = 1): void
    {
        Mail::assertQueuedTimes($mailable, $times);
    }

    protected function assertMailNotQueued(string $mailable): void
    {
        Mail::assertNotQueued($mailable);
    }
}
