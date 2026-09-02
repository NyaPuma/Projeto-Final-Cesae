# `app/Http/Controllers/Ticket`

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Specialized controllers for specific ticket lifecycle operations. Each controller handles a single responsibility within the ticket workflow.

## Controllers

| Controller | Purpose |
|---|---|
| `TicketAssignmentController` | Assign or reassign a technician to a ticket |
| `TicketCloseController` | Close/resolve a ticket with a resolution note |
| `TicketLifecycleController` | Ticket status transitions (open → in progress → resolved) |
| `TicketScheduleController` | Schedule or reschedule a ticket's due date |
| `TicketStartController` | Start working on a ticket (transition to in-progress) |

## Design

These controllers are split from the main `TicketController` to keep each file focused on a single workflow action. They follow the same patterns as other controllers:

- **Final** classes extending `Controller`
- **Constructor injection** of action/service dependencies
- **Policy-based authorization** via `$this->authorize()`
- **JSON responses** with success messages and resource data

## Dependencies

| Dependency | Used For |
|---|---|
| `App\Domain\Ticket\Actions\*` | Workflow action classes |
| `App\Services\TicketStatusService` | Status name → ID resolution |
| `App\Http\Resources\TicketResource` | Response serialization |
| `App\Policies\TicketPolicy` | Authorization checks |

## Related Folders

| Path | Relationship |
|---|---|
| `app/Http/Controllers/TicketController.php` | Main ticket CRUD controller |
| `app/Domain/Ticket/Actions/` | Action classes for ticket operations |
| `app/Domain/Ticket/Services/` | Domain services |
| `app/Policies/TicketPolicy` | Authorization rules |
