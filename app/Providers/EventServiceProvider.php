<?php

namespace App\Providers;

use App\Events\TicketCreatedBroadcast;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Listeners\BroadcastTicketUpdate;
use App\Listeners\LogTicketStatusChange;
use App\Listeners\NotifyAssignedTechnician;
use App\Listeners\SendTicketStatusNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TicketStatusUpdatedBroadcast::class => [
            SendTicketStatusNotification::class,
            LogTicketStatusChange::class,
            NotifyAssignedTechnician::class,
        ],
        TicketCreatedBroadcast::class => [
            BroadcastTicketUpdate::class,
        ],
    ];
}
