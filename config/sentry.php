<?php

declare(strict_types=1);

use Sentry\Event;

return [

    'dsn' => env('SENTRY_LARAVEL_DSN', env('SENTRY_DSN')),

    'release' => env('SENTRY_RELEASE'),

    'environment' => env('SENTRY_ENVIRONMENT', env('APP_ENV', 'production')),

    'sample_rate' => (float) env('SENTRY_SAMPLE_RATE', 1.0),

    'traces_sample_rate' => (float) env('SENTRY_TRACES_SAMPLE_RATE', 0.1),

    'profiles_sample_rate' => (float) env('SENTRY_PROFILES_SAMPLE_RATE', 0.0),

    'send_default_pii' => false,

    'ignore_transactions' => [
        '/up',
    ],

    'breadcrumbs' => [
        'logs' => true,
        'cache' => true,
        'sql_queries' => true,
        'sql_bindings' => false,
        'queue_info' => true,
        'command_info' => true,
        'http_client_requests' => true,
        'notifications' => true,
    ],

    'tracing' => [
        'queue_job_transactions' => true,
        'queue_jobs' => true,
        'sql_queries' => true,
        'sql_bindings' => false,
        'sql_origin' => true,
        'sql_origin_threshold_ms' => 100,
        'views' => true,
        'http_client_requests' => true,
        'cache' => true,
        'redis_commands' => false,
        'notifications' => true,
        'missing_routes' => false,
        'continue_after_response' => true,
    ],

    'before_send' => static function (Event $event): Event {
        $sanitize = static function (mixed $value) use (&$sanitize): mixed {
            if (! is_array($value)) {
                return $value;
            }

            $result = [];

            foreach ($value as $key => $item) {
                $keyString = strtolower((string) $key);

                if (preg_match('/password|token|secret|api[_-]?key|authorization|card|cvv/', $keyString) === 1) {
                    $result[$key] = '[REDACTED]';
                } else {
                    $result[$key] = $sanitize($item);
                }
            }

            return $result;
        };

        $request = $sanitize($event->getRequest());

        if (is_array($request)) {
            $event->setRequest($request);
        }

        foreach ($event->getContexts() as $name => $context) {
            $sanitizedContext = $sanitize($context);

            if (is_array($sanitizedContext)) {
                $event->setContext($name, $sanitizedContext);
            }
        }

        $extra = $sanitize($event->getExtra());

        if (is_array($extra)) {
            $event->setExtra($extra);
        }

        return $event;
    },

];
