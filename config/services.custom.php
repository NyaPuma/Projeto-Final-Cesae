<?php

return [
    'auth' => [
        'max_attempts' => env('AUTH_MAX_ATTEMPTS', 5),
        'lockout_minutes' => env('AUTH_LOCKOUT_MINUTES', 15),
    ],
    'budget' => [
        'threshold' => env('BUDGET_THRESHOLD', 50.00),
    ],
    'analytics' => [
        'system_availability' => env('SYSTEM_AVAILABILITY', 99.9),
    ],
    'ai' => [
        'model' => env('AI_MODEL', 'gpt-4o-mini'),
        'temperature' => env('AI_TEMPERATURE', 0.1),
    ],
    'pagination' => [
        'default_per_page' => env('PAGINATION_PER_PAGE', 15),
        'admin_per_page' => env('ADMIN_PAGINATION_PER_PAGE', 50),
    ],
    'tokens' => [
        'length' => env('API_TOKEN_LENGTH', 60),
    ],
    'notification' => [
        'mailer' => env('NOTIFICATION_MAILER', 'mailgun_fallback'),
    ],
];
