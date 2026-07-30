<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;

trait InteractsWithQueue
{
    protected function fakeQueue(): void
    {
        Queue::fake();
    }

    protected function fakeBus(): void
    {
        Bus::fake();
    }

    protected function assertJobPushed(string $job, ?callable $callback = null): void
    {
        Queue::assertPushed($job, $callback);
    }

    protected function assertJobPushedTimes(string $job, int $times = 1): void
    {
        Queue::assertPushedTimes($job, $times);
    }

    protected function assertJobNotPushed(string $job): void
    {
        Queue::assertNotPushed($job);
    }

    protected function assertNothingPushed(): void
    {
        Queue::assertNothingPushed();
    }

    protected function assertJobDispatched(string $job, ?callable $callback = null): void
    {
        Bus::assertDispatched($job, $callback);
    }

    protected function assertJobDispatchedTimes(string $job, int $times = 1): void
    {
        Bus::assertDispatchedTimes($job, $times);
    }

    protected function assertJobNotDispatched(string $job): void
    {
        Bus::assertNotDispatched($job);
    }

    protected function assertNothingDispatched(): void
    {
        Bus::assertNothingDispatched();
    }

    protected function assertJobDispatchedAfter(string $job, string $afterJob): void
    {
        Bus::assertDispatchedAfter($afterJob, $job);
    }

    protected function assertJobDispatchedWithout(string $job, string $withoutJob): void
    {
        Bus::assertDispatchedWithout($job, $withoutJob);
    }
}
