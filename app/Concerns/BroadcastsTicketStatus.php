<?php

namespace App\Concerns;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use Illuminate\Support\Facades\Log;
use Throwable;

trait BroadcastsTicketStatus
{
    /**
     * Broadcast ticket status change via WebSockets and dispatch notification to ticket owner.
     */
    protected function broadcastStatusChange(
        Ticket $ticket,
        TicketStatusEnum|string $oldStatus,
        TicketStatusEnum|string $newStatus
    ): void {
        $oldStatusValue = $oldStatus instanceof TicketStatusEnum ? $oldStatus->value : $oldStatus;
        $newStatusValue = $newStatus instanceof TicketStatusEnum ? $newStatus->value : $newStatus;

        try {
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatusValue, $newStatusValue));

            /** @var User|null $user */
            $user = $ticket->user;

            if ($user?->email) {
                $user->notify(new TicketStatusChanged($ticket, $oldStatusValue, $newStatusValue));
            }
        } catch (Throwable $e) {
            Log::warning('Failed to broadcast ticket status change.', [
                'ticket_id' => $ticket->id,
                'old_status' => $oldStatusValue,
                'new_status' => $newStatusValue,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
