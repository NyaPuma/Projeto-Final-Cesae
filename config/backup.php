<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backup Configuration
    |--------------------------------------------------------------------------
    |
    | Configuração para backups da base de dados. Utiliza mysqldump (MySQL)
    | ou sqlite3 (SQLite) diretamente, sem dependência de packages externos.
    |
    */

    'database' => [

        'connection' => env('DB_BACKUP_CONNECTION', null),

        'destination' => [

            'path' => storage_path('app/backups'),

            'filename' => 'backup_'.date('Y-m-d_His').'.sql',

        ],

        'compression' => env('DB_BACKUP_COMPRESSION', true),

        'exclude_tables' => [
            'failed_jobs',
            'personal_access_tokens',
        ],

    ],

    'retention' => [

        'days' => (int) env('DB_BACKUP_RETENTION_DAYS', 30),

    ],

];
