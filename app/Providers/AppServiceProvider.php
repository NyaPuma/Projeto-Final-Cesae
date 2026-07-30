<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Audit;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Observers\AuditObserver;
use App\Observers\TicketObserver;
use App\Observers\UserObserver;
use App\Policies\EquipmentPolicy;
use App\Policies\RoomPolicy;
use App\Policies\TicketPolicy;
use App\Policies\UserPolicy;
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
use App\Services\TicketStatusService;
use Illuminate\Database\Events\QueryExecuted;
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
    }

    /**
     * Bootstrap de quaisquer serviços da aplicação.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerObservers();
        $this->registerSlowQueryListener();
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
