# app/Listeners

Event listeners that handle side effects when ticket events are dispatched. All listeners are queued.

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "The Follow-Up Team" that automatically reacts when something important happens.

## Overview

This folder contains **5 listener classes** that respond to the 3 ticket events (`TicketCreated`, `TicketStatusChanged`, `TicketStatusUpdatedBroadcast`). All listeners implement `ShouldQueue` and use `InteractsWithQueue`, meaning they run asynchronously in the queue worker after the event is dispatched.

**Event → Listener mapping** (defined in `app/Providers/EventServiceProvider.php`):

```
TicketCreated
  └── SendTicketCreatedNotification

TicketStatusChanged
  └── LogTicketWorkflowChange

TicketStatusUpdatedBroadcast
  ├── SendTicketStatusNotification
  ├── LogTicketStatusChange
  └── NotifyAssignedTechnician
```

Event discovery is **disabled** (`shouldDiscoverEvents()` returns `false`) — all mappings are explicit for performance and control.

---

## Files

### `LogTicketStatusChange.php`

**What it is:** Logs a ticket status transition to the `TicketWorkflowHistory` table when the `TicketStatusUpdatedBroadcast` event fires. Uses an optimized single-query lookup to resolve both old and new status IDs.

**Class:** `App\Listeners\LogTicketStatusChange`

**Triggers on:** `App\Events\TicketStatusUpdatedBroadcast`

**Registered in:** `EventServiceProvider.php:32-35`:
```php
TicketStatusUpdatedBroadcast::class => [
    SendTicketStatusNotification::class,
    LogTicketStatusChange::class,
    NotifyAssignedTechnician::class,
],
```

**Dependencies:**
- `App\Models\TicketStatus` — queried to resolve status name strings to database IDs.
- `App\Models\TicketWorkflowHistory` — the model where the log record is created.

**`handle(TicketStatusUpdatedBroadcast $event)` logic:**
1. Extracts `$oldStatus->value` and `$newStatus->value` from the event (these are the `TicketStatusEnum` string values, e.g. `'aberto'`, `'em_curso'`).
2. **Single-query optimization:** Fetches both `TicketStatus` records in one query using `TicketStatus::whereIn('name', [$oldStatus, $newStatus])->get()->keyBy('name')`. This avoids the N+1 problem of making two separate queries.
3. If either status cannot be found, logs a warning and returns early (no crash, no retry).
4. Creates a `TicketWorkflowHistory` record with:
   - `ticket_id` — from `$event->ticket->id`
   - `origin_status_id` — the database ID of the old status
   - `destination_status_id` — the database ID of the new status
   - `technician_id` — from `$event->ticket->assigned_to` (the currently assigned technician)
   - `comment` — `'Status changed from "aberto" to "em_curso".'`

**`failed()` logic:**
- Logs a warning with the ticket ID and error message via `Log::warning()`.

**Queue configuration:**
- `$tries = 3`

---

### `LogTicketWorkflowChange.php`

**What it is:** Logs a ticket status transition to the `TicketWorkflowHistory` table when the `TicketStatusChanged` event fires. This is the observer-level counterpart to `LogTicketStatusChange`, handling transitions triggered by Eloquent model updates rather than explicit controller actions.

**Class:** `App\Listeners\LogTicketWorkflowChange`

**Triggers on:** `App\Events\TicketStatusChanged`

**Registered in:** `EventServiceProvider.php:28-30`:
```php
TicketStatusChanged::class => [
    LogTicketWorkflowChange::class,
],
```

**Dependencies:**
- `App\Models\TicketStatus` — queried to resolve status name strings to database IDs.
- `App\Models\TicketWorkflowHistory` — the model where the log record is created.

**`handle(TicketStatusChanged $event)` logic:**
1. Queries `TicketStatus::where('name', $event->oldStatus->value)->value('id')` to get the origin status ID.
2. Queries `TicketStatus::where('name', $event->newStatus->value)->value('id')` to get the destination status ID.
3. Creates a `TicketWorkflowHistory` record with:
   - `ticket_id` — from `$event->ticket->id`
   - `origin_status_id` — from step 1
   - `destination_status_id` — from step 2
   - `technician_id` — from `$event->changedBy->id` if `$event->changedBy` is not null, otherwise falls back to `auth()->id()` (the currently authenticated user).
   - `comment` — `'Status changed from "aberto" to "em_curso".'`

**Key difference from `LogTicketStatusChange`:**
- `LogTicketStatusChange` (for `TicketStatusUpdatedBroadcast`) does a single-query lookup with `whereIn`.
- `LogTicketWorkflowChange` (for `TicketStatusChanged`) does two separate queries (one per status).
- `LogTicketWorkflowChange` uses `$event->changedBy->id ?? auth()->id()` for the technician, while `LogTicketStatusChange` uses `$event->ticket->assigned_to`.

**`failed()` logic:**
- Logs an error with the ticket ID and error message via `Log::error()`.

**Queue configuration:**
- `$tries = 3`

---

### `NotifyAssignedTechnician.php`

**What it is:** Sends a `NewTicketNotification` (mail + database) to the technician assigned to a ticket when the ticket's status changes.

**Class:** `App\Listeners\NotifyAssignedTechnician`

**Triggers on:** `App\Events\TicketStatusUpdatedBroadcast`

**Registered in:** `EventServiceProvider.php:32-35`:
```php
TicketStatusUpdatedBroadcast::class => [
    SendTicketStatusNotification::class,
    LogTicketStatusChange::class,
    NotifyAssignedTechnician::class,
],
```

**Dependencies:**
- `App\Models\User` — used to check if the technician exists and has an email.
- `App\Notifications\NewTicketNotification` — the notification class sent to the technician.

**`handle(TicketStatusUpdatedBroadcast $event)` logic:**
1. Gets the ticket from the event.
2. Checks if `$ticket->assigned_to` is set. If not, returns early (no technician assigned).
3. Loads the `$ticket->technician` relationship (the `User` model for the assigned technician).
4. If the technician is a valid `User` instance with a non-null `email`, sends `new NewTicketNotification($ticket)` to them via `$technician->notify(...)`.
5. The `NewTicketNotification` sends an email + database notification to the technician about the ticket.

**`failed()` logic:**
- Logs a warning with the ticket ID, assigned technician ID, and error message.

**Queue configuration:**
- `$tries = 3`
- `$backoff = [5, 15, 30]`

---

### `SendTicketCreatedNotification.php`

**What it is:** Delegates new-ticket notification logic to `NotificationService::notifyTicketCreated()` when a `TicketCreated` event fires. This is the only listener for the `TicketCreated` event.

**Class:** `App\Listeners\SendTicketCreatedNotification`

**Triggers on:** `App\Events\TicketCreated`

**Registered in:** `EventServiceProvider.php:25-27`:
```php
TicketCreated::class => [
    SendTicketCreatedNotification::class,
],
```

**Dependencies:**
- `App\Services\NotificationService` — injected via constructor. This is a singleton service registered in `AppServiceProvider`.

**Constructor:**
```php
public function __construct(
    private readonly NotificationService $notificationService,
) {}
```

**`handle(TicketCreated $event)` logic:**
1. Calls `$this->notificationService->notifyTicketCreated($event->ticket)`.
2. This delegates to `BudgetNotificationService::notifyTicketCreated()` which calls `NotificationCreatorService::createForAdmins()` to create an in-app notification for every admin user with:
   - `title`: `"New Ticket - #{$ticket->id}"`
   - `message`: `"New ticket created: {$ticket->title}"`
   - `type`: `NotificationTypeEnum::TicketCreated->value`
   - `link`: `"/ui/tickets/{$ticket->id}"`

**`failed()` logic:**
- Logs an error with the ticket ID and error message.

**Queue configuration:**
- `$tries = 3`
- `$backoff = [5, 15, 30]`

---

### `SendTicketStatusNotification.php`

**What it is:** Sends a `TicketStatusChanged` notification (mail + database) to the ticket owner when the ticket's status changes.

**Class:** `App\Listeners\SendTicketStatusNotification`

**Triggers on:** `App\Events\TicketStatusUpdatedBroadcast`

**Registered in:** `EventServiceProvider.php:32-35`:
```php
TicketStatusUpdatedBroadcast::class => [
    SendTicketStatusNotification::class,
    LogTicketStatusChange::class,
    NotifyAssignedTechnician::class,
],
```

**Dependencies:**
- `App\Models\User` — used to check if the ticket owner exists and has an email.
- `App\Notifications\TicketStatusChanged` — the notification class sent to the ticket owner.

**`handle(TicketStatusUpdatedBroadcast $event)` logic:**
1. Gets the ticket from the event.
2. Loads the `$ticket->user` relationship (the `User` model for the ticket creator/owner).
3. If the user is a valid `User` instance with a non-null `email`, sends `new TicketStatusChanged($ticket, $event->oldStatus->value, $event->newStatus->value)` to them via `$user->notify(...)`.
4. The `TicketStatusChanged` notification sends an email + database notification with the old and new status labels.

**`failed()` logic:**
- Logs a warning with the ticket ID and error message.

**Queue configuration:**
- `$tries = 3`
- `$backoff = [5, 15, 30]`

---

## Notes for developers / AI

- All listeners implement `ShouldQueue` and use `InteractsWithQueue`.
- Common `$tries = 3` and `$backoff = [5, 15, 30]` across notification listeners (`SendTicketStatusNotification`, `NotifyAssignedTechnician`, `SendTicketCreatedNotification`).
- `LogTicketStatusChange` does a single-query lookup for both origin and destination statuses to avoid N+1.
- `LogTicketWorkflowChange` does two separate queries (one per status) — a simpler but less optimized approach.
- `NotifyAssignedTechnician` and `SendTicketStatusNotification` both guard against missing relationships (`assigned_to` being null, `user` not having an email) to avoid exceptions on edge-case tickets.
- `SendTicketCreatedNotification` is the only listener that receives its dependency via constructor injection (`NotificationService`); the other 4 listeners resolve their dependencies inline from the event or use facade calls.
