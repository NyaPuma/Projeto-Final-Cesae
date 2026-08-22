# app/Observers

Eloquent model observers that react to model lifecycle events and trigger side effects.

## Files

| File | Purpose |
|---|---|
| `AuditObserver.php` | Prevents any update, delete, or force-delete on `Audit` records — audit trail is immutable |
| `TicketObserver.php` | Fires `TicketCreated` and `TicketStatusChanged` events on model creation/update; invalidates analytics cache on every mutation |
| `UserObserver.php` | Ensures every user has a valid `UserProfile` on creating/updating; assigns default profile if missing or invalid |

## Notes for developers / AI

- All observers are `final readonly` classes.
- `AuditObserver` throws `LogicException` on any mutation attempt — this is intentional to enforce immutability.
- `TicketObserver::invalidateAnalyticsCache()` clears the `analytics_dashboard_payload` cache key on every ticket change.
- `UserObserver` uses `firstOrCreate` to lazily bootstrap the default profile.
