<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseBackup extends Command
{
    protected $signature = 'db:backup
                    {--connection= : The database connection to use}
                    {--path= : Custom output path}
                    {--no-compress : Skip gzip compression}
                    {--clean : Remove backups older than retention period}';

    protected $description = 'Create a database backup using native tools (mysqldump/sqlite3)';

    public function handle(): int
    {
        $connection = $this->option('connection') ?? config('backup.database.connection') ?? config('database.default');
        $config = config("database.connections.{$connection}");

        if (! $config) {
            $this->error("Connection '{$connection}' not found in config/database.php");

            return self::FAILURE;
        }

        $backupDir = $this->option('path') ?? config('backup.database.destination.path', storage_path('app/backups'));
        File::makeDirectory($backupDir, 0755, true, true);

        $timestamp = now()->format('Y-m-d_His');
        $filename = "backup_{$timestamp}.sql";
        $filepath = rtrim($backupDir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$filename;

        $this->info("Backing up connection: {$connection}");
        $this->info("Driver: {$config['driver']}");

        try {
            match ($config['driver']) {
                'mysql' => $this->backupMysql($config, $filepath),
                'sqlite' => $this->backupSqlite($config, $filepath),
                default => throw new \RuntimeException("Unsupported driver: {$config['driver']}"),
            };

            $this->info("Backup created: {$filepath}");
            $this->info('Size: '.number_format(File::size($filepath)).' bytes');

            if (! $this->option('no-compress') && config('backup.database.compression', true)) {
                $this->compressBackup($filepath);
            }

            if ($this->option('clean')) {
                $this->cleanOldBackups($backupDir);
            }

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Backup failed: {$e->getMessage()}");

            return self::FAILURE;
        }
    }

    private function backupMysql(array $config, string $filepath): void
    {
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? 3306;
        $database = $config['database'];
        $username = $config['username'] ?? 'root';
        $password = $config['password'] ?? '';

        $excludeTables = config('backup.database.exclude_tables', []);

        $cmd = sprintf(
            'mysqldump -h %s -P %d -u %s %s %s --routines --triggers --single-transaction --result-file=%s 2>&1',
            escapeshellarg($host),
            (int) $port,
            escapeshellarg($username),
            $password ? '-p'.escapeshellarg($password) : '',
            escapeshellarg($database),
            implode(' ', array_map('escapeshellarg', array_map(fn ($t) => "--ignore-table={$database}.{$t}", $excludeTables))),
            escapeshellarg($filepath),
        );

        exec($cmd, $output, $exitCode);

        if ($exitCode !== 0) {
            throw new \RuntimeException('mysqldump failed: '.implode("\n", $output));
        }
    }

    private function backupSqlite(array $config, string $filepath): void
    {
        $database = $config['database'] ?? $config['sqlite'] ?? database_path('database.sqlite');

        if (! file_exists($database)) {
            throw new \RuntimeException("SQLite database file not found: {$database}");
        }

        $cmd = sprintf(
            'sqlite3 %s .dump > %s 2>&1',
            escapeshellarg($database),
            escapeshellarg($filepath),
        );

        exec($cmd, $output, $exitCode);

        if ($exitCode !== 0) {
            throw new \RuntimeException('sqlite3 dump failed: '.implode("\n", $output));
        }
    }

    private function compressBackup(string $filepath): void
    {
        $gzFile = $filepath.'.gz';

        exec("gzip -c ".escapeshellarg($filepath).' > '.escapeshellarg($gzFile), $output, $exitCode);

        if ($exitCode === 0 && file_exists($gzFile)) {
            unlink($filepath);
            $this->info("Compressed: {$gzFile} (".number_format(File::size($gzFile)).' bytes)');
        }
    }

    private function cleanOldBackups(string $backupDir): void
    {
        $retentionDays = config('backup.retention.days', 30);
        $cutoff = now()->subDays($retentionDays);

        $files = File::glob($backupDir.DIRECTORY_SEPARATOR.'backup_*');
        $removed = 0;

        foreach ($files as $file) {
            if (File::lastModified($file) < $cutoff->timestamp) {
                File::delete($file);
                $removed++;
            }
        }

        $this->info("Removed {$removed} backups older than {$retentionDays} days");
    }
}
