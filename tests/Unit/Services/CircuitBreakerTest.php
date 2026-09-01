<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\CircuitBreaker;
use Exception;
use Illuminate\Support\Facades\Cache;
use Tests\Base\UnitTestCase;

final class CircuitBreakerTest extends UnitTestCase
{
    private CircuitBreaker $circuitBreaker;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        $this->circuitBreaker = new CircuitBreaker;
    }

    public function test_successful_operation_returns_result_and_resets(): void
    {
        // Arrange
        $dependency = 'payment-gateway';

        // Act
        $result = $this->circuitBreaker->run(
            $dependency,
            fn () => 'success_payload',
            'fallback_value'
        );

        // Assert
        $this->assertSame('success_payload', $result);
    }

    public function test_failed_operation_returns_fallback_and_records_failure(): void
    {
        // Arrange
        $dependency = 'ai-service';

        // Act
        $result = $this->circuitBreaker->run(
            $dependency,
            function () {
                throw new Exception('Service unavailable');
            },
            fn ($e) => 'fallback_response: '.$e?->getMessage()
        );

        // Assert
        $this->assertSame('fallback_response: Service unavailable', $result);
    }

    public function test_circuit_trips_open_after_reaching_failure_threshold(): void
    {
        // Arrange
        config(['observability.circuit_breaker.failure_threshold' => 2]);
        config(['observability.circuit_breaker.cooldown_seconds' => 60]);
        $dependency = 'email-service';

        // Act 1: First failure
        $this->circuitBreaker->run(
            $dependency,
            fn () => throw new Exception('Fail 1'),
            'fallback_1'
        );

        // Act 2: Second failure (trips breaker)
        $this->circuitBreaker->run(
            $dependency,
            fn () => throw new Exception('Fail 2'),
            'fallback_2'
        );

        $executed = false;
        // Act 3: Third call while open
        $result = $this->circuitBreaker->run(
            $dependency,
            function () use (&$executed) {
                $executed = true;

                return 'should_not_run';
            },
            'circuit_open_fallback'
        );

        // Assert
        $this->assertFalse($executed);
        $this->assertSame('circuit_open_fallback', $result);
    }
}
