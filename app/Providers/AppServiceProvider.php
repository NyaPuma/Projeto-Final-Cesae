<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Audit;
use App\Models\Equipment;
use App\Models\MaintenancePlan;
use App\Models\Part;
use App\Models\PartCategory;
use App\Models\Room;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\TaxRate;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Observers\AuditObserver;
use App\Observers\TicketObserver;
use App\Observers\UserObserver;
use App\Policies\EquipmentPolicy;
use App\Policies\MaintenancePlanPolicy;
use App\Policies\PartCategoryPolicy;
use App\Policies\PartPolicy;
use App\Policies\RoomPolicy;
use App\Policies\StockMovementPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\TaxRatePolicy;
use App\Policies\TicketPolicy;
use App\Policies\UserPolicy;
use App\Policies\UserProfilePolicy;
use App\Repositories\Contracts\EquipmentRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\EquipmentRepository;
use App\Repositories\RoomRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use App\Services\AIService;
use App\Services\AnalyticsService;
use App\Services\LocalizationService;
use App\Services\NotificationService;
use App\Services\SystemSettingsService;
use App\Services\TicketStatusService;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Registers all services and contract bindings in the application.
     */
    public function register(): void
    {
        // Bind interfaces to concrete repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(EquipmentRepositoryInterface::class, EquipmentRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);

        // Register domain services as singletons
        $this->app->singleton(TicketStatusService::class);
        $this->app->singleton(AnalyticsService::class);
        $this->app->singleton(NotificationService::class);
        $this->app->singleton(AIService::class);
        $this->app->singleton(SystemSettingsService::class);
    }

    /**
     * Bootstraps any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerObservers();
        $this->registerSlowQueryListener();
        $this->registerQueueObservability();
        $this->registerFormattingDirectives();

        // Apply overrides saved in the Settings → Configuration page
        $this->app->make(SystemSettingsService::class)->applyOverrides();
    }

    /**
     * Registers authorization policies for the models.
     */
    private function registerPolicies(): void
    {
        Gate::policy(Ticket::class, TicketPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Equipment::class, EquipmentPolicy::class);
        Gate::policy(Room::class, RoomPolicy::class);
        Gate::policy(UserProfile::class, UserProfilePolicy::class);
        Gate::policy(Part::class, PartPolicy::class);
        Gate::policy(Supplier::class, SupplierPolicy::class);
        Gate::policy(StockMovement::class, StockMovementPolicy::class);
        Gate::policy(TaxRate::class, TaxRatePolicy::class);
        Gate::policy(PartCategory::class, PartCategoryPolicy::class);
        Gate::policy(MaintenancePlan::class, MaintenancePlanPolicy::class);
    }

    /**
     * Registers localized formatting directives used in views.
     */
    private function registerFormattingDirectives(): void
    {
        $service = LocalizationService::class;

        Blade::directive('money', static fn (string $expr) => "<?php echo app({$service}::class)->formatCurrency($expr); ?>");
        Blade::directive('number', static fn (string $expr) => "<?php echo app({$service}::class)->formatNumber($expr); ?>");
        Blade::directive('percent', static fn (string $expr) => "<?php echo app({$service}::class)->formatPercent($expr); ?>");
        Blade::directive('date', static fn (string $expr) => "<?php echo app({$service}::class)->formatDate($expr); ?>");
        Blade::directive('datetime', static fn (string $expr) => "<?php echo app({$service}::class)->formatDateTime($expr); ?>");

        // @localized* directives
        Blade::directive('localizedDate', static fn (string $expr) => "<?php echo app({$service}::class)->formatDate($expr); ?>");
        Blade::directive('localizedDateTime', static fn (string $expr) => "<?php echo app({$service}::class)->formatDateTime($expr); ?>");
        Blade::directive('localizedNumber', static fn (string $expr) => "<?php echo app({$service}::class)->formatNumber($expr); ?>");
        Blade::directive('localizedCurrency', static fn (string $expr) => "<?php echo app({$service}::class)->formatCurrency($expr); ?>");
        Blade::directive('localizedUnit', static fn (string $expr) => "<?php echo app({$service}::class)->convertUnit($expr)['formatted']; ?>");
    }

    /**
     * Registers observers responsible for listening to model lifecycle events.
     */
    private function registerObservers(): void
    {
        Ticket::observe(TicketObserver::class);
        User::observe(UserObserver::class);
        Audit::observe(AuditObserver::class);
    }

    /**
     * Registers a listener to detect and log slow SQL queries.
     */
    private function registerSlowQueryListener(): void
    {
        if (! config('database.connections.mysql.slow_query_log', false)) {
            return;
        }

        $thresholdMs = (float) config('database.connections.mysql.slow_query_threshold_ms', 100);

        DB::listen(function (QueryExecuted $query) use ($thresholdMs): void {
            if ($query->time >= $thresholdMs) {
                Log::warning('Slow database query detected', [
                    'metric' => 'database.query.duration_ms',
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'duration_ms' => round($query->time, 2),
                ]);
            }
        });
    }

    /**
     * Registers queue timing and failure telemetry.
     */
    private function registerQueueObservability(): void
    {
        $startedAt = [];

        Queue::before(function (JobProcessing $event) use (&$startedAt): void {
            $startedAt[(string) $event->job->getJobId()] = microtime(true);
        });

        Queue::after(function (JobProcessed $event) use (&$startedAt): void {
            $jobId = (string) $event->job->getJobId();
            $started = $startedAt[$jobId] ?? null;
            unset($startedAt[$jobId]);

            if (! is_float($started)) {
                return;
            }

            $durationMs = round((microtime(true) - $started) * 1000, 2);

            if ($durationMs >= (float) config('observability.queue_slow_job_threshold_ms', 1000)) {
                Log::warning('Slow queue job detected', [
                    'metric' => 'queue.job.duration_ms',
                    'job' => $event->job->resolveName(),
                    'job_id' => $jobId,
                    'duration_ms' => $durationMs,
                ]);
            }
        });

        Queue::failing(function (JobFailed $event): void {
            Log::error('Queue job failed', [
                'metric' => 'queue.job.failure',
                'job' => $event->job->resolveName(),
                'job_id' => (string) $event->job->getJobId(),
                'exception' => $event->exception->getMessage(),
            ]);

            try {
                \Sentry\captureException($event->exception);
            } catch (\Throwable $reportingException) {
                Log::warning('Sentry queue failure reporting failed', [
                    'exception' => $reportingException->getMessage(),
                ]);
            }
        });
    }
}
