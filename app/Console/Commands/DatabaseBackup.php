<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DatabaseBackup extends Command
{
    protected $signature = 'db:backup
                            {--retention=30 : Number of days to keep backups}
                            {--compress : Compress the backup with gzip}';

    protected $description = 'Create a database backup using mysqldump and optionally prune old backups';

    public function handle(): int
    {
        $host = config('database.connections.mysql.host', '127.0.0.1');
        $port = config('database.connections.mysql.port', '3306');
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        if (! $database) {
            $this->error('No database name configured.');

            return Command::FAILURE;
        }

        $backupDir = storage_path('backups');
        if (! is_dir($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $timestamp = now()->format('Y-m-d_H-i-s');
        $filename = "backup_{$database}_{$timestamp}.sql";
        $filepath = "{$backupDir}/{$filename}";

        $cmd = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers %s > %s 2>&1',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($filepath)
        );

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error('mysqldump failed: '.implode("\n", $output));

            return Command::FAILURE;
        }

        if ($this->option('compress')) {
            exec("gzip {$filepath}", $output, $gzipCode);
            if ($gzipCode === 0) {
                $filepath .= '.gz';
                $filename .= '.gz';
            }
        }

        $size = File::size($filepath);
        $this->info("Backup created: {$filename} ({$this->formatBytes($size)})");

        $retentionDays = (int) $this->option('retention');
        $this->pruneOldBackups($backupDir, $retentionDays);

        return Command::SUCCESS;
    }

    private function pruneOldBackups(string $directory, int $retentionDays): void
    {
        $cutoff = now()->subDays($retentionDays);
        $files = File::files($directory);
        $pruned = 0;

        foreach ($files as $file) {
            if ($file->getFilename() === '.gitignore') {
                continue;
            }

            if ($file->getMTime() < $cutoff->timestamp) {
                File::delete($file->getPathname());
                $pruned++;
            }
        }

        if ($pruned > 0) {
            $this->info("Pruned {$pruned} backup(s) older than {$retentionDays} days.");
        }
    }

    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor((strlen((string) $bytes) - 1) / 3);

        return sprintf("%.{$precision}f", $bytes / (1024 ** $factor)).' '.$units[$factor];
    }
}
