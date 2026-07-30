<?php

namespace App\Listeners;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class NotifyAssignedTechnician implements ShouldQueue
{
    public function handle(TicketStatusUpdatedBroadcast $event): void
    {
        try {
            $ticket = $event->ticket;

            if (! $ticket->assigned_to) {
                return;
            }

            /** @var User|null $technician */
            $technician = $ticket->relationLoaded('technician')
                ? $ticket->technician
                : $ticket->technician()->first();

            if ($technician instanceof User && $technician->email) {
                $technician->notify(new NewTicketNotification);
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to notify assigned technician', [
                'ticket_id' => $event->ticket->id,
                'assigned_to' => $event->ticket->assigned_to,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
