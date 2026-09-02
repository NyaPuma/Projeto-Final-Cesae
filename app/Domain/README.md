# app/Domain

Domain-specific business logic organized by bounded context.

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "Specialized Departments" where business rules are organized by what they do.

## What is the "Domain"?

Think of this folder as the **brain of the application**. While other folders handle things like HTTP requests, database connections, or file uploads, this folder contains the pure **business rules** -- the knowledge that makes SGM work as a maintenance-management system.

For example: "A ticket can only be closed if it is currently in progress" is a business rule. It lives here, not in a controller or a database file, because it describes **how the system should behave**, not how data is stored or delivered.

This pattern is called **Domain-Driven Design (DDD) lite**. The idea is simple: organize code by **what the business cares about** (tickets, users, equipment), not by technical layers (controllers, models, etc.).

## How it fits into the bigger picture

```
HTTP Request
    |
    v
Controllers (app/Http/Controllers)   <-- "The receptionist" -- receives requests
    |
    v
Domain (app/Domain)                  <-- "The specialist department" -- applies business rules
    |
    v
Models & DB (app/Models, database/)  <-- "The filing cabinet" -- stores/retrieves data
```

When a user clicks "Close Ticket" on the dashboard, the controller calls into `app/Domain/Ticket/Actions/CloseTicketAction`. That Action checks the rules (is the ticket already closed?), updates the status, records the timestamp, and returns a result. The controller never has to know the rules -- it just delegates to the Domain.

**In practice**, the Domain actions are not called directly from controllers in this codebase. Instead, `app/Services/TicketWorkflowService` acts as a **facade/orchestrator** that wraps each Domain action and exposes high-level methods (`startRepair()`, `close()`, `reopen()`, `cancel()`, `findHigherPriorityTickets()`). Controllers inject `TicketWorkflowService` rather than individual Domain actions. This adds a layer of cross-cutting concerns (e.g., wrapping `close()` in an outer `DB::transaction`).

## Subdirectories

| Directory | Purpose |
|---|---|
| `Ticket/` | Ticket domain logic -- actions, queries, services, and value objects specific to ticket management. This is currently the only domain module in the system. |

## Domain action invocation chain (concrete)

```
TicketStartController::__invoke()
  └─> TicketWorkflowService::startRepair()
        └─> StartTicketAction::execute()

TicketCloseController::simpleClose() / closeFinal()
  └─> TicketWorkflowService::close()
        └─> CloseTicketAction::execute()

TicketLifecycleController::reopen()
  └─> TicketWorkflowService::reopen()
        └─> ReopenTicketAction::execute()

TicketLifecycleController::cancel()
  └─> TicketWorkflowService::cancel()
        └─> CancelTicketAction::execute()

TicketStartController::__invoke() / TicketCloseController::closeFinal()
  └─> TicketWorkflowService::findHigherPriorityTickets()
        └─> CheckHigherPriorityAction::execute()

AnalyticsController::index()
  └─> AnalyticsService::getDashboardPayload()
        └─> AnalyticsDashboardService::buildPayload()
              ├─> TicketKpiQuery::execute()
              ├─> TicketPriorityQuery::execute()
              ├─> MonthlyTicketsQuery::execute()
              └─> TopEntitiesQuery::getTopEquipments() / getTopRooms() / getTopTechnicians()

CalendarController::events()
  └─> CalendarService::getScheduledEvents()
        └─> ScheduledEventsQuery::execute()
```

## Notes for developers / AI

- This follows a DDD-lite structure where domain logic is grouped by entity rather than by layer.
- Each domain subdirectory (e.g., `Ticket/`) contains its own Actions, Queries, Services, and ValueObjects.
- Domain classes are designed to be **testable in isolation** -- they receive their dependencies through constructor injection, so you can swap real databases for mocks during testing.
- Business rules that span multiple entities (e.g., "closing a ticket may trigger a notification to the building manager") should live here, not in controllers.
- The `TicketWorkflowService` in `app/Services/` is the primary entry point that controllers use to invoke Domain actions. It composes all five ticket lifecycle actions.
- Query classes (`app/Domain/Ticket/Queries/`) are consumed by `AnalyticsDashboardService` and `CalendarService` in `app/Services/`, which are themselves called by controllers.
