<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use RuntimeException;
use Throwable;

class DatabaseBackup extends Command
{
    protected $signature = 'db:backup
                    {--connection= : A conexão da base de dados a utilizar}
                    {--path= : Caminho personalizado para os backups}
                    {--no-compress : Ignorar compressão gzip}
                    {--clean : Remover backups mais antigos que o período de retenção}';

    protected $description = 'Cria um backup da base de dados utilizando ferramentas nativas (mysqldump/sqlite3)';

    public function handle(): int
    {
        $connection = $this->option('connection') ?? config('backup.database.connection') ?? config('database.default');
        $config = config("database.connections.{$connection}");

        if (! $config) {
            $this->error("A conexão '{$connection}' não foi encontrada em config/database.php");

            return self::FAILURE;
        }

        $backupDir = $this->option('path') ?? config('backup.database.destination.path', storage_path('app/backups'));
        File::makeDirectory($backupDir, 0755, true, true);

        $timestamp = now()->format('Y-m-d_His');
        $filename = "backup_{$timestamp}.sql";
        $filepath = rtrim($backupDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;

        $this->info("A iniciar backup da conexão: {$connection}");
        $this->info("Driver: {$config['driver']}");

        try {
            match ($config['driver']) {
                'mysql' => $this->backupMysql($config, $filepath),
                'sqlite' => $this->backupSqlite($config, $filepath),
                default => throw new RuntimeException("Driver não suportado: {$config['driver']}"),
            };

            $this->info("Backup criado com sucesso: {$filepath}");
            $this->info('Tamanho original: ' . number_format(File::size($filepath)) . ' bytes');

            if (! $this->option('no-compress') && config('backup.database.compression', true)) {
                $filepath = $this->compressBackup($filepath);
            }

            if ($this->option('clean')) {
                $this->cleanOldBackups($backupDir);
            }

            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error("Falha ao efetuar o backup: {$e->getMessage()}");

            // Remove the incomplete file if the process failed
            if (File::exists($filepath)) {
                File::delete($filepath);
            }

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

        $ignoreArgs = $excludeTables
            ? implode(' ', array_map('escapeshellarg', array_map(fn ($t) => "--ignore-table={$database}.{$t}", $excludeTables)))
            : '';

        // We don't pass the password via CLI to avoid exposing it in the process table
        $cmd = sprintf(
            'mysqldump -h %s -P %d -u %s %s %s --routines --triggers --single-transaction --result-file=%s',
            escapeshellarg($host),
            (int) $port,
            escapeshellarg($username),
            escapeshellarg($database),
            $ignoreArgs,
            escapeshellarg($filepath)
        );

        // Inject the password securely via the MYSQL_PWD environment variable
        $result = Process::env(['MYSQL_PWD' => $password])
            ->timeout(600) // 10-minute timeout for larger databases
            ->run($cmd);

        if ($result->failed()) {
            throw new RuntimeException('mysqldump falhou: ' . $result->errorOutput());
        }
    }

    private function backupSqlite(array $config, string $filepath): void
    {
        $database = $config['database'] ?? database_path('database.sqlite');

        if (! File::exists($database)) {
            throw new RuntimeException("Ficheiro da base de dados SQLite não encontrado: {$database}");
        }

        $cmd = sprintf(
            'sqlite3 %s .dump > %s',
            escapeshellarg($database),
            escapeshellarg($filepath)
        );

        $result = Process::timeout(600)->run($cmd);

        if ($result->failed()) {
            throw new RuntimeException('sqlite3 dump falhou: ' . $result->errorOutput());
        }
    }

    /**
     * Compresses the backup file using PHP's native zlib extension.
     */
    private function compressBackup(string $filepath): string
    {
        $gzFile = $filepath . '.gz';

        $fpOut = gzopen($gzFile, 'wb9');
        $fpIn = fopen($filepath, 'rb');

        if (! $fpOut || ! $fpIn) {
            throw new RuntimeException('Não foi possível inicializar os streams de compressão Gzip.');
        }

        while (! feof($fpIn)) {
            gzwrite($fpOut, fread($fpIn, 524288)); // Read in 512KB chunks
        }

        fclose($fpIn);
        gzclose($fpOut);

        if (File::exists($gzFile)) {
            File::delete($filepath);
            $this->info("Comprimido com sucesso: {$gzFile} (" . number_format(File::size($gzFile)) . ' bytes)');
            return $gzFile;
        }

        return $filepath;
    }

    private function cleanOldBackups(string $backupDir): void
    {
        $retentionDays = config('backup.retention.days', 30);
        $cutoff = now()->subDays($retentionDays);

        $files = File::glob($backupDir . DIRECTORY_SEPARATOR . 'backup_*');
        $removed = 0;

        foreach ($files as $file) {
            if (File::lastModified($file) < $cutoff->timestamp) {
                File::delete($file);
                $removed++;
            }
        }

        $this->info("Removidos {$removed} backups com idade superior a {$retentionDays} dias.");
    }
}
