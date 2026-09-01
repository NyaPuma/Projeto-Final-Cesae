<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Backup Configuration
    |--------------------------------------------------------------------------
    |
| Database backup configuration. Uses mysqldump (MySQL)
| or sqlite3 (SQLite) directly, without external package dependencies.
    |
    */

    'database' => [

        'connection' => env('DB_BACKUP_CONNECTION', null),

        'destination' => [

            'path' => storage_path('app/backups'),

            'filename' => 'backup_'.date('Y-m-d_His').'.sql',

        ],

        'compression' => (bool) env('DB_BACKUP_COMPRESSION', true),

        'exclude_tables' => [
            'failed_jobs',
            'personal_access_tokens',
        ],

    ],

    'retention' => [

        'days' => (int) env('DB_BACKUP_RETENTION_DAYS', 30),

    ],

];
