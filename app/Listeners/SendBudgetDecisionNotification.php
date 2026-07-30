<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\BudgetApproved;
use App\Events\BudgetRejected;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

final class SendBudgetDecisionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * O número de vezes que o listener pode ser tentado na fila.
     */
    public int $tries = 3;

    /**
     * Intervalo de espera (em segundos) entre as tentativas.
     *
     * @var array<int, int>
     */
    public array $backoff = [5, 15, 30];

    public function __construct(
        private readonly NotificationService $notificationService,
    ) {}

    public function handle(BudgetApproved|BudgetRejected $event): void
    {
        $isApproved = $event instanceof BudgetApproved;
        $decision = $isApproved ? 'approve' : 'reject';

        if ($isApproved) {
            $formattedAmount = number_format((float) $event->amount, 2, ',', '.');
            $message = "O orçamento de {$formattedAmount}€ para o ticket #{$event->ticket->id} foi APROVADO.";
        } else {
            $reason = ! empty($event->feedback) ? " Motivo: {$event->feedback}" : '';
            $message = "O orçamento para o ticket #{$event->ticket->id} foi RECUSADO.{$reason}";
        }

        $this->notificationService->notifyBudgetDecision($event->ticket, $decision, $message);
    }

    /**
     * Regista a falha no log caso o envio da notificação falhe em todas as tentativas.
     */
    public function failed(BudgetApproved|BudgetRejected $event, Throwable $exception): void
    {
        Log::error('Failed to send budget decision notification', [
            'ticket_id' => $event->ticket->id,
            'event_type' => $event::class,
            'error' => $exception->getMessage(),
        ]);
    }
}
