<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\FeatureFlagService;
use Illuminate\Console\Command;

final class FeatureFlagCommand extends Command
{
    protected $signature = 'feature
                            {action : The action to perform: enable, disable, or clear}
                            {name : The feature flag name}';

    protected $description = 'Manage a runtime feature flag override';

    public function handle(FeatureFlagService $featureFlags): int
    {
        $action = (string) $this->argument('action');
        $name = (string) $this->argument('name');

        match ($action) {
            'enable' => $featureFlags->enable($name),
            'disable' => $featureFlags->disable($name),
            'clear' => $featureFlags->clear($name),
            default => $this->error('Action must be enable, disable, or clear.'),
        };

        if (in_array($action, ['enable', 'disable', 'clear'], true)) {
            $this->info("Feature flag '{$name}' {$action} action completed.");

            return self::SUCCESS;
        }

        return self::INVALID;
    }
}
