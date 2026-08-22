# app/Domain/Ticket/Services

Domain-level service classes for ticket-specific business logic.

## Files

| File | Purpose |
|---|---|
| `TicketStatusChecker.php` | Checks whether a ticket (or raw status ID) matches an expected status enum value. Resolves the enum to a database ID via `TicketStatusService`. |

## Notes for developers / AI

- This is a single-purpose service for status comparison. For status transitions, see `app/Domain/Ticket/Actions/`.
- Accepts `Ticket|int|null` to support both model instances and raw IDs.
- Returns `false` for invalid/null status IDs rather than throwing exceptions.
