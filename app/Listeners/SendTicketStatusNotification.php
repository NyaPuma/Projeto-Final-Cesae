<?php

namespace App\Listeners;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendTicketStatusNotification implements ShouldQueue
{
    public function handle(TicketStatusUpdatedBroadcast $event): void
    {
        try {
            /** @var User|null $user */
            $user = $event->ticket->relationLoaded('user')
                ? $event->ticket->user
                : $event->ticket->user()->first();

            if ($user instanceof User && $user->email) {
                $user->notify(new TicketStatusChanged(
                    $event->ticket,
                    $event->oldStatus,
                    $event->newStatus
                ));
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to send ticket status notification', [
                'ticket_id' => $event->ticket->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
