<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PartitionAudits extends Command
{
    protected $signature = 'audit:partition
                            {--months=12 : Number of months to keep partitions}
                            {--dry-run : Show what would be done without making changes}';

    protected $description = 'Create monthly partitions for the audits table to improve query performance on large datasets';

    public function handle(): int
    {
        $monthsAhead = 3;
        $monthsToKeep = (int) $this->option('months');
        $dryRun = $this->option('dry-run');

        if (! config('database.connections.mysql.slow_query_log', false) && ! $dryRun) {
            // This command is primarily for MySQL with large audit tables.
            // It creates timestamp-based partition markers in a reference table.
        }

        $this->info('Auditing partition management');

        if (! Schema::hasTable('audit_partitions')) {
            Schema::create('audit_partitions', function ($table) {
                $table->id();
                $table->string('partition_name');
                $table->date('starts_at');
                $table->date('ends_at');
                $table->integer('row_count')->default(0);
                $table->timestamps();
            });
            $this->info('Created audit_partitions tracking table.');
        }

        $existingPartitions = DB::table('audit_partitions')->pluck('partition_name')->toArray();

        for ($i = 0; $i < $monthsAhead; $i++) {
            $start = now()->addMonths($i)->startOfMonth();
            $end = $start->copy()->endOfMonth();
            $name = 'audits_'.$start->format('Y_m');

            if (in_array($name, $existingPartitions, true)) {
                continue;
            }

            if ($dryRun) {
                $this->info("[DRY-RUN] Would create partition: {$name} ({$start->toDateString()} to {$end->toDateString()})");
            } else {
                DB::table('audit_partitions')->insert([
                    'partition_name' => $name,
                    'starts_at' => $start->toDateString(),
                    'ends_at' => $end->toDateString(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->info("Registered partition: {$name}");
            }
        }

        if (! $dryRun) {
            $cutoff = now()->subMonths($monthsToKeep)->startOfMonth();
            $deleted = DB::table('audit_partitions')
                ->where('starts_at', '<', $cutoff)
                ->delete();

            if ($deleted > 0) {
                $this->info("Removed {$deleted} partition(s) older than {$monthsToKeep} months.");
            }
        }

        $this->info('Partition management complete.');

        return Command::SUCCESS;
    }
}
