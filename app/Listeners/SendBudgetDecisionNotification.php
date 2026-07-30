<?php

namespace App\Listeners;

use App\Events\BudgetApproved;
use App\Events\BudgetRejected;
use App\Services\NotificationService;

final readonly class SendBudgetDecisionNotification
{
    public function __construct(
        private readonly NotificationService $notificationService,
    ) {}

    public function handle(BudgetApproved|BudgetRejected $event): void
    {
        $decision = $event instanceof BudgetApproved ? 'approve' : 'reject';
        $message = $event instanceof BudgetApproved
            ? "O orçamento de {$event->amount}€ para o ticket #{$event->ticket->id} foi APROVADO."
            : "O orçamento para o ticket #{$event->ticket->id} foi RECUSADO."
                .($event->feedback ? " Motivo: {$event->feedback}" : '');

        $this->notificationService->notifyBudgetDecision($event->ticket, $decision, $message);
    }
}
