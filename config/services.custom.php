<?php

declare(strict_types=1);

return [
    'auth' => [
        'max_attempts' => (int) env('AUTH_MAX_ATTEMPTS', 5),
        'lockout_minutes' => (int) env('AUTH_LOCKOUT_MINUTES', 15),
    ],
    'budget' => [
        'threshold' => (float) env('BUDGET_THRESHOLD', 50.00),
    ],
    'analytics' => [
        'system_availability' => (float) env('SYSTEM_AVAILABILITY', 99.9),
    ],
    'ai' => [
        'model' => env('AI_MODEL', 'gpt-4o-mini'),
        'temperature' => (float) env('AI_TEMPERATURE', 0.1),
    ],
    'pagination' => [
        'default_per_page' => (int) env('PAGINATION_PER_PAGE', 15),
        'admin_per_page' => (int) env('ADMIN_PAGINATION_PER_PAGE', 50),
    ],
    'tokens' => [
        'length' => (int) env('API_TOKEN_LENGTH', 60),
    ],
    'notification' => [
        'mailer' => env('NOTIFICATION_MAILER', 'mailgun_fallback'),
    ],
];
