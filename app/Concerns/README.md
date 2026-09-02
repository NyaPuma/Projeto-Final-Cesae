# app/Concerns

Reusable traits and behavior mixins focused on cross-cutting application capabilities (real-time broadcasting, notification triggers).

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "The Shared Toolbelt" -- reusable behaviors that any worker can pick up and use.

## Files

| File | Purpose |
|---|---|
| [`BroadcastsTicketStatus.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Concerns/BroadcastsTicketStatus.php) | Provides the standard helper `broadcastStatusChange()` to broadcast WebSocket updates (`TicketStatusUpdatedBroadcast`) and trigger email/push notifications (`TicketStatusChanged`) when a ticket changes state. |

---

## `BroadcastsTicketStatus.php`

**File:** `app/Concerns/BroadcastsTicketStatus.php`

### What reusable behavior it provides

A single, consistent way for any ticket controller to **announce a ticket status transition**. When a controller calls `broadcastStatusChange()`, the concern:
1. dispatches the `App\Events\TicketStatusUpdatedBroadcast` event (WebSocket/real-time update for connected clients), and
2. notifies the ticket's owner via the `App\Notifications\TicketStatusChanged` notification (email/push).

It normalizes both old and new statuses (accepting either `TicketStatusEnum` instances or plain strings) and guarantees that a broadcast/notification failure never breaks the surrounding ticket workflow.

### Method

| Member | Signature | Purpose |
|---|---|---|
| `broadcastStatusChange()` | `protected function broadcastStatusChange(Ticket $ticket, TicketStatusEnum|string $oldStatus, TicketStatusEnum|string $newStatus): void` | Normalizes both statuses to raw strings (`$oldStatusValue`, `$newStatusValue` via `instanceof TicketStatusEnum ? $status->value : $status`). Emits `new TicketStatusUpdatedBroadcast($ticket, $oldStatusValue, $newStatusValue)` through Laravel's `event()` helper, then, if `$ticket->user?->email` exists, sends `new TicketStatusChanged($ticket, $oldStatusValue, $newStatusValue)` to that user via `$user->notify(...)`. Entire body wrapped in `try/catch (Throwable)` → `Log::warning('Failed to broadcast ticket status change.', ['ticket_id', 'old_status', 'new_status', 'error'])`. |

### Which classes use it

Grep of `use App\Concerns\BroadcastsTicketStatus` across `app/Http/Controllers`:

| Class | File | Usage of `broadcastStatusChange()` |
|---|---|---|
| `App\Http\Controllers\Ticket\TicketLifecycleController` | `app/Http/Controllers/Ticket/TicketLifecycleController.php:5` | `:43` (reopen), `:77` (cancel) |
| `App\Http\Controllers\Ticket\TicketStartController` | `app/Http/Controllers/Ticket/TicketStartController.php:5` | `:82` (start → `InProgress`) |
| `App\Http\Controllers\Ticket\TicketCloseController` | `app/Http/Controllers/Ticket/TicketCloseController.php:5` | `:53` and `:112` (close → `Closed`) |
| `App\Http\Controllers\Ticket\TicketAssignmentController` | `app/Http/Controllers/Ticket/TicketAssignmentController.php:5` | `:62` (assign → `InProgress`) |

Each of these controllers declares `use BroadcastsTicketStatus;` (e.g. `app/Http/Controllers/Ticket/TicketLifecycleController.php:16`), which makes the protected `broadcastStatusChange()` available. The transition values passed are the controller-resolved `oldStatus` (loaded before the workflow mutation) and the new status (a `TicketStatusEnum` constant such as `InProgress`, `Cancelled`, `Closed`, or the refreshed `$ticket->status`).

## Notes for Developers & AI

- **Non-blocking Error Handling:** Broadcasting and email notifications are encapsulated in `try/catch` blocks with error logging, ensuring core ticket transitions succeed even if broadcasting channels are offline.
- **Type Flexibility:** Accepts either a `TicketStatusEnum` instance or a raw string for both old and new status parameters.
- **Dependency contract:** requires the ticket's `user` relation to be loadable (`$ticket->user`) and the user to have an `email`; a technician/admin ticket with no owner simply skips the notification step.
- **Event → listener wiring** for `TicketStatusUpdatedBroadcast` (including `NotifyAssignedTechnician`) is configured in `app/Providers/EventServiceProvider.php` — see the Providers README.