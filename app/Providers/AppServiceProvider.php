<?php

namespace App\Providers;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\EquipmentPolicy;
use App\Policies\RoomPolicy;
use App\Policies\TicketPolicy;
use App\Policies\UserPolicy;
use App\Services\AIService;
use App\Services\AnalyticsService;
use App\Services\NotificationService;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TicketStatusService::class);
        $this->app->singleton(AnalyticsService::class);
        $this->app->singleton(NotificationService::class);
        $this->app->singleton(AIService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerSlowQueryListener();
    }

    private function registerPolicies(): void
    {
        Gate::policy(Ticket::class, TicketPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Equipment::class, EquipmentPolicy::class);
        Gate::policy(Room::class, RoomPolicy::class);
    }

    private function registerSlowQueryListener(): void
    {
        if (! config('database.connections.mysql.slow_query_log', false)) {
            return;
        }

        $threshold = config('database.connections.mysql.slow_query_threshold', 2);

        DB::listen(function ($query) use ($threshold) {
            $time = $query->time / 1000;
            if ($time >= $threshold) {
                Log::warning('Slow query detected', [
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => round($time, 3).'s',
                ]);
            }
        });
    }
}
