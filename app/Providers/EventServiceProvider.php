<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\TicketCreated;
use App\Events\TicketStatusChanged;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Listeners\LogTicketStatusChange;
use App\Listeners\LogTicketWorkflowChange;
use App\Listeners\NotifyAssignedTechnician;
use App\Listeners\SendTicketCreatedNotification;
use App\Listeners\SendTicketStatusNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento de eventos e os respetivos listeners da aplicação.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        TicketCreated::class => [
            SendTicketCreatedNotification::class,
        ],
        TicketStatusChanged::class => [
            LogTicketWorkflowChange::class,
        ],
        TicketStatusUpdatedBroadcast::class => [
            SendTicketStatusNotification::class,
            LogTicketStatusChange::class,
            NotifyAssignedTechnician::class,
        ],
    ];

    /**
     * Regista quaisquer eventos para a aplicação.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Determina se os eventos e listeners devem ser detetados automaticamente.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false; // Mantém o mapeamento explícito por razões de desempenho e controlo
    }
}
