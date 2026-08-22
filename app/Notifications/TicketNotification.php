<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

final class TicketNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly string $title,
        public readonly string $message,
        public readonly string $type = 'info',
        public readonly ?string $link = null,
    ) {}

    /**
     * Defines the notification channels (broadcast via WebSockets and database).
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast', 'database'];
    }

    /**
     * Payload broadcast in real time via WebSockets (Reverb / Pusher).
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title'   => $this->title,
            'message' => $this->message,
            'type'    => $this->type,
            'link'    => $this->link,
        ]);
    }

    /**
     * Payload stored in the 'notifications' database table.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'   => $this->title,
            'message' => $this->message,
            'type'    => $this->type,
            'link'    => $this->link,
        ];
    }
}
