# app/Listeners

Event listeners that handle side effects when ticket events are dispatched. All listeners are queued.

## Files

| File | Purpose |
|---|---|
| `LogTicketStatusChange.php` | Logs ticket status transitions to `TicketWorkflowHistory` when `TicketStatusUpdatedBroadcast` fires; fetches both status IDs in a single query |
| `LogTicketWorkflowChange.php` | Logs ticket workflow transitions to `TicketWorkflowHistory` when `TicketStatusChanged` fires |
| `NotifyAssignedTechnician.php` | Sends a `NewTicketNotification` to the assigned technician when `TicketStatusUpdatedBroadcast` fires |
| `SendTicketCreatedNotification.php` | Delegates to `NotificationService::notifyTicketCreated()` when `TicketCreated` fires |
| `SendTicketStatusNotification.php` | Sends a `TicketStatusChanged` notification to the ticket owner when status changes |

## Notes for developers / AI

- All listeners implement `ShouldQueue` and use `InteractsWithQueue`.
- Common `$tries = 3` and `$backoff = [5, 15, 30]` across notification listeners.
- `LogTicketStatusChange` does a single-query lookup for both origin and destination statuses to avoid N+1.
