<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\Event;

trait InteractsWithEvents
{
    protected function fakeEvents(): void
    {
        Event::fake();
    }

    protected function assertEventDispatched(string $eventClass, ?callable $callback = null): void
    {
        Event::assertDispatched($eventClass, $callback);
    }

    protected function assertEventDispatchedTimes(string $eventClass, int $times = 1): void
    {
        Event::assertDispatchedTimes($eventClass, $times);
    }

    protected function assertEventNotDispatched(string $eventClass): void
    {
        Event::assertNotDispatched($eventClass);
    }

    protected function assertNothingDispatched(): void
    {
        Event::assertNothingDispatched();
    }

    protected function assertEventDispatchedAfter(string $eventClass, string $afterEventClass): void
    {
        Event::assertDispatchedAfter($afterEventClass, $eventClass);
    }

    protected function assertEventDispatchedWithout(string $eventClass, string $withoutEventClass): void
    {
        Event::assertDispatchedWithout($eventClass, $withoutEventClass);
    }
}
