<?php

namespace App\Providers;

use App\Events\BudgetApproved;
use App\Events\BudgetRejected;
use App\Events\TicketCreated;
use App\Events\TicketCreatedBroadcast;
use App\Events\TicketStatusChanged;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Listeners\BroadcastTicketUpdate;
use App\Listeners\LogTicketStatusChange;
use App\Listeners\LogTicketWorkflowChange;
use App\Listeners\NotifyAssignedTechnician;
use App\Listeners\SendBudgetDecisionNotification;
use App\Listeners\SendTicketCreatedNotification;
use App\Listeners\SendTicketStatusNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TicketCreated::class => [
            SendTicketCreatedNotification::class,
        ],
        TicketStatusChanged::class => [
            LogTicketWorkflowChange::class,
        ],
        BudgetApproved::class => [
            SendBudgetDecisionNotification::class,
        ],
        BudgetRejected::class => [
            SendBudgetDecisionNotification::class,
        ],
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
