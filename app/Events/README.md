# app/Events

Broadcast events for real-time ticket status updates via WebSockets (Laravel Echo).

## Files

| File | Purpose |
|---|---|
| `TicketCreated.php` | Broadcasts when a new ticket is created; includes ticket details, status, priority, and creator info; channels: creator + admin |
| `TicketStatusChanged.php` | Broadcasts when a ticket status changes; includes old/new status with labels and colors, changed-by user; channels: ticket + user + admin |
| `TicketStatusUpdatedBroadcast.php` | Broadcasts immediately (ShouldBroadcastNow) when a ticket status is updated; similar payload to TicketStatusChanged but without changedBy; used by listeners for workflow logging and notifications |

## Notes for developers / AI

- All events implement `ShouldBroadcast` (queued) or `ShouldBroadcastNow` (immediate).
- All use `PrivateChannel` for authenticated broadcasting.
- Broadcast event names: `ticket.created`, `ticket.status_changed`, `ticket.status.updated`.
- Payload arrays include pre-computed `label()` and `color()` from enums for direct UI consumption.
