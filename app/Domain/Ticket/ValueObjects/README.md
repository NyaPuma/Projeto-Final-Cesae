# app/Domain/Ticket/ValueObjects

Domain-specific value objects for ticket-related calculations.

## Files

| File | Purpose |
|---|---|
| `BudgetPauseMinutes.php` | Calculates the elapsed time (in minutes and hours) between a budget request and its decision. Implements `Stringable` and `JsonSerializable` for easy output. |

## Notes for developers / AI

- Immutable (`final readonly`) value object.
- Returns 0 for incomplete or invalid pause data (missing timestamps or decision before request).
- Used to track how long a ticket was paused waiting for budget approval.
