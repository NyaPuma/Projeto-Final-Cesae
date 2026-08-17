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
use App\Services\NotificationService;
use App\Services\SystemSettingsService;
use App\Services\TicketStatusService;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Regista todos os serviços e vinculações de contratos na aplicação.
     */
    public function register(): void
    {
        // Vinculação de Interfaces aos Repositórios Concretos
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(EquipmentRepositoryInterface::class, EquipmentRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);

        // Registo de Serviços de Domínio como Singletons
        $this->app->singleton(TicketStatusService::class);
        $this->app->singleton(AnalyticsService::class);
        $this->app->singleton(NotificationService::class);
        $this->app->singleton(AIService::class);
        $this->app->singleton(SystemSettingsService::class);
    }

    /**
     * Bootstrap de quaisquer serviços da aplicação.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerObservers();
        $this->registerSlowQueryListener();
        $this->registerFormattingDirectives();

        // Aplica os overrides guardados na página de Definições → Configurações
        $this->app->make(SystemSettingsService::class)->applyOverrides();
    }

    /**
     * Regista as políticas de autorização para os modelos.
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
     * Regista as directives de formatação localizada usadas nas views.
     */
    private function registerFormattingDirectives(): void
    {
        $service = \App\Services\LocalizationService::class;

        Blade::directive('money', static fn (string $expr) => "<?php echo app({$service}::class)->formatCurrency($expr); ?>");
        Blade::directive('number', static fn (string $expr) => "<?php echo app({$service}::class)->formatNumber($expr); ?>");
        Blade::directive('percent', static fn (string $expr) => "<?php echo app({$service}::class)->formatPercent($expr); ?>");
        Blade::directive('date', static fn (string $expr) => "<?php echo app({$service}::class)->formatDate($expr); ?>");
        Blade::directive('datetime', static fn (string $expr) => "<?php echo app({$service}::class)->formatDateTime($expr); ?>");

        // Diretivas @localized*
        Blade::directive('localizedDate', static fn (string $expr) => "<?php echo app({$service}::class)->formatDate($expr); ?>");
        Blade::directive('localizedDateTime', static fn (string $expr) => "<?php echo app({$service}::class)->formatDateTime($expr); ?>");
        Blade::directive('localizedNumber', static fn (string $expr) => "<?php echo app({$service}::class)->formatNumber($expr); ?>");
        Blade::directive('localizedCurrency', static fn (string $expr) => "<?php echo app({$service}::class)->formatCurrency($expr); ?>");
        Blade::directive('localizedUnit', static fn (string $expr) => "<?php echo app({$service}::class)->convertUnit($expr)['formatted']; ?>");
    }

    /**
     * Regista os observers responsáveis por escutar os ciclos de vida dos modelos.
     */
    private function registerObservers(): void
    {
        Ticket::observe(TicketObserver::class);
        User::observe(UserObserver::class);
        Audit::observe(AuditObserver::class);
    }

    /**
     * Regista o listener para detetar e registar em log consultas SQL lentas.
     */
    private function registerSlowQueryListener(): void
    {
        if (! config('database.connections.mysql.slow_query_log', false)) {
            return;
        }

        $threshold = (float) config('database.connections.mysql.slow_query_threshold', 2);

        DB::listen(function (QueryExecuted $query) use ($threshold): void {
            $timeInSeconds = $query->time / 1000;

            if ($timeInSeconds >= $threshold) {
                Log::warning('Slow query detected', [
                    'sql'      => $query->sql,
                    'bindings' => $query->bindings,
                    'time'     => round($timeInSeconds, 3) . 's',
                ]);
            }
        });
    }
}
