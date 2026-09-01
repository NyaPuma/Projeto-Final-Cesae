<?php

declare(strict_types=1);

return [

    'slow_request_threshold_ms' => (float) env('OBSERVABILITY_SLOW_REQUEST_THRESHOLD_MS', 100),

    'high_memory_threshold_mb' => (float) env('OBSERVABILITY_HIGH_MEMORY_THRESHOLD_MB', 128),

    'queue_slow_job_threshold_ms' => (float) env('OBSERVABILITY_QUEUE_SLOW_JOB_THRESHOLD_MS', 1000),

    'circuit_breaker' => [
        'failure_threshold' => (int) env('CIRCUIT_BREAKER_FAILURE_THRESHOLD', 3),
        'cooldown_seconds' => (int) env('CIRCUIT_BREAKER_COOLDOWN_SECONDS', 60),
    ],

];
