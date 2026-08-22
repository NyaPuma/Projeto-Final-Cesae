# app/Notifications

Notification classes for delivering ticket-related alerts via mail, database, and broadcast channels.

## Files

| File | Purpose |
|---|---|
| `NewTicketNotification.php` | Sends a mail + database notification to admins when a new ticket is created |
| `TicketNotification.php` | Generic broadcast + database notification for real-time ticket updates |
| `TicketStatusChanged.php` | Sends a mail + database notification to the ticket owner when status changes |

## Notes for developers / AI

- All notifications implement `ShouldQueue` for async delivery.
- Notification content strings (greetings, lines, subjects) are in Portuguese — managed by the i18n project.
- `NewTicketNotification` and `TicketStatusChanged` use both `mail` and `database` channels.
- `TicketNotification` uses `broadcast` and `database` channels for real-time delivery.
- `TicketStatusChanged::resolveStatusLabel()` maps status strings to human-friendly labels via `TicketStatusEnum`.
