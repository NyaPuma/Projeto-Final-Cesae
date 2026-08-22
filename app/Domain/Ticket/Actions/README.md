# app/Domain/Ticket/Actions

Domain-level action classes for ticket lifecycle operations. These actions handle state transitions (start, close, cancel, reopen) and priority analysis for tickets.

## Files

| File | Purpose |
|---|---|
| `CancelTicketAction.php` | Cancels a ticket by setting its status to Cancelled and recording the close timestamp. No-op if already cancelled. |
| `CheckHigherPriorityAction.php` | Queries for open tickets with strictly higher priority than the given ticket. Returns total count, count assigned to the same technician, and a boolean flag. |
| `CloseTicketAction.php` | Closes a ticket, optionally recording actual cost, technical report, and time spent. No-op if already closed. |
| `ReopenTicketAction.php` | Reopens a closed or cancelled ticket back to Open status. Clears `closed_at` and records `reopened_at`. |
| `StartTicketAction.php` | Transitions a ticket to InProgress status. Optionally assigns a technician if not already assigned. Preserves original start time if re-entering InProgress. |

## Notes for developers / AI

- All actions are `final readonly` with a single `execute()` method.
- Each action depends on `TicketStatusService::getByName()` to resolve enum values to database IDs.
- Guard clauses at the top of methods handle idempotent cases (e.g., closing an already-closed ticket returns `true` without mutation).
- State transitions assume the status enum values exist in the database — `RuntimeException` is thrown if they don't.
- These actions are called from controllers and other services, not directly from routes.
