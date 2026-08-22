# app/Domain/Ticket/Queries

Read-only query classes that fetch ticket-related data for dashboards and analytics. Each query is a self-contained, testable unit that accepts its dependencies via constructor.

## Files

| File | Purpose |
|---|---|
| `MonthlyTicketsQuery.php` | Returns ticket counts (open, in-progress, closed) and costs aggregated by month for the last 6 months. Handles SQLite/MySQL date formatting differences. |
| `ScheduledEventsQuery.php` | Returns scheduled tickets within an optional date range, formatted for calendar display (FullCalendar-compatible ISO 8601 timestamps). |
| `TicketKpiQuery.php` | Returns key performance indicators: open/in-progress/closed ticket counts, average resolution and waiting times, and SLA compliance rate. |
| `TicketPriorityQuery.php` | Returns ticket counts grouped by priority level (low, medium, high) from a given base query. |
| `TopEntitiesQuery.php` | Returns the top 5 equipment, rooms, and technicians by ticket count. Used for dashboard "top entities" widgets. |

## Notes for developers / AI

- Queries accept pre-built Eloquent `Builder` instances or status IDs via constructor — they don't resolve status names themselves.
- `MonthlyTicketsQuery` and `TicketKpiQuery` use raw SQL expressions with driver-specific branching (SQLite vs MySQL/PostgreSQL).
- `TicketPriorityQuery` and `TopEntitiesQuery` clone the base query before modifying it to avoid side effects.
- The `subtitle` values in `TopEntitiesQuery` are user-facing display strings (Portuguese) — these are handled by the i18n system, not this refactoring.
