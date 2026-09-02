# app/Domain/Ticket/Services

Domain-level service classes for ticket-specific business logic.

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- these are "The Ticket Status Checkers" that verify where a ticket is in its journey before important actions happen.

## The Big Picture

Think of Services as **quality inspectors on the factory floor**. Before a worker (Action) performs a step, the inspector checks a condition: "Is this ticket actually in the right state for what we're about to do?" Services don't make changes -- they answer yes-or-no questions that other parts of the system rely on.

This keeps business logic reusable. Instead of every Action and controller independently figuring out how to check a ticket's status, they all delegate to the same Service.

---

## `TicketStatusChecker.php`

**File:** `app/Domain/Ticket/Services/TicketStatusChecker.php`
**What it is:** Checks whether a ticket (or a raw status ID number) matches an expected status, such as "Is this ticket currently Open?"

**Dependencies (constructor):**
- `TicketStatusService $statusService` -- resolves `TicketStatusEnum` values to their database IDs

**Public methods:**

### `hasStatus(Ticket|int|null $ticketOrStatusId, TicketStatusEnum $status): bool`

1. **Extracts the status ID:**
   - If `$ticketOrStatusId` is a `Ticket` model instance, extracts `$ticketOrStatusId->status_id`.
   - If it's an `int`, uses it directly.
   - If it's `null`, proceeds with `null`.
2. **Guard clause:** If `$statusId === null || $statusId <= 0`, returns `false` immediately (no valid ticket, no match).
3. Resolves the expected status: `$expectedStatusId = $this->statusService->getByName($status)`.
4. Compares: returns `true` if `$statusId === $expectedStatusId`, `false` otherwise.

**Who calls it and when:**
- No production caller found. This service is defined but not currently imported by any controller, action, or other service in `app/`. The `Ticket` model itself has a `hasStatus()` method that is used by domain actions (`ReopenTicketAction`, `ScheduleTicketAction`, `SubmitBudgetAction`, etc.) and controllers directly.
- Used in tests only: `tests/Feature/Domain/TicketStatusCheckerTest.php`.

**Note:** Although `TicketStatusChecker` exists as a domain service, the codebase currently uses `$ticket->hasStatus(TicketStatusEnum::Closed)` (the model's own method) instead of injecting this checker. This class is available for future use or for contexts where you only have a raw status ID rather than a loaded model.

---

## Notes for developers / AI

- This is a single-purpose service for status comparison. For status transitions, see `app/Domain/Ticket/Actions/`.
- Accepts `Ticket|int|null` to support both model instances and raw IDs.
- Returns `false` for invalid/null status IDs rather than throwing exceptions.
- The service is `final readonly` and designed for constructor injection.
- `TicketStatusService` (in `app/Services/`) is a separate, non-Domain service that handles the actual database lookup for status enum-to-ID mapping. `TicketStatusChecker` wraps it with a convenient boolean interface.
