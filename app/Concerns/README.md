# app/Concerns

Reusable traits and behavior mixins focused on cross-cutting application capabilities (real-time broadcasting, notification triggers).

## Files

| File | Purpose |
|---|---|
| [`BroadcastsTicketStatus.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Concerns/BroadcastsTicketStatus.php) | Provides standard helper `broadcastStatusChange()` to broadcast WebSocket updates (`TicketStatusUpdatedBroadcast`) and trigger email/push notifications (`TicketStatusChanged`) when a ticket changes state. |

## Notes for Developers & AI

- **Non-blocking Error Handling:** Broadcasting and email notifications are encapsulated in `try/catch` blocks with error logging, ensuring core ticket transitions succeed even if broadcasting channels are offline.
- **Type Flexibility:** Accepts either a `TicketStatusEnum` instance or a raw string for both old and new status parameters.
