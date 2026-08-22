# `app/`

Application source code for the SGM (Fault/Maintenance Management System) platform. This is a Laravel application following standard Laravel conventions with domain-driven organization.

## Directory Structure

| Directory | Purpose |
|---|---|
| `Actions/` | Single-purpose command/action classes (CQRS-style) |
| `Concerns/` | Shared PHP traits used across models |
| `Console/` | Artisan console commands |
| `Domain/` | Domain-specific modules (currently: Ticket workflow) |
| `DTOs/` | Data Transfer Objects for typed data passing |
| `Enums/` | PHP 8.1+ enums for domain values |
| `Events/` | Laravel event classes |
| `Exports/` | CSV/PDF export implementations |
| `Http/` | Controllers, middleware, requests, resources (web + API) |
| `Jobs/` | Queued jobs for async processing |
| `Listeners/` | Event listener classes |
| `Mail/` | Mailable classes for email sending |
| `Models/` | Eloquent models (database table mappings) |
| `Notifications/` | Notification classes (database, mail, broadcast) |
| `Observers/` | Eloquent model observers |
| `OpenApi/` | OpenAPI/Swagger documentation classes |
| `Policies/` | Authorization policy classes |
| `Providers/` | Laravel service providers |
| `Repositories/` | Repository pattern (data access abstraction) |
| `Services/` | Business logic / domain services |
| `Traits/` | Shared PHP traits |
| `ValueObjects/` | Immutable value objects (Money, SerialNumber, etc.) |

## Architecture

The application uses a layered architecture:

1. **HTTP Layer** (`Http/`) — Controllers handle requests, delegate to services/actions
2. **Service Layer** (`Services/`) — Business logic orchestration
3. **Action Layer** (`Actions/`, `Domain/*/Actions/`) — Single-purpose command handlers
4. **Repository Layer** (`Repositories/`) — Data access abstraction over Eloquent
5. **Model Layer** (`Models/`) — Eloquent ORM models

## Key Patterns

- **Repository Pattern** — Interfaces in `Repositories/Contracts/`, implementations in `Repositories/`
- **Action Pattern** — Single-purpose classes in `Actions/` and `Domain/*/Actions/`
- **Observer Pattern** — Model lifecycle hooks in `Observers/`
- **Policy Pattern** — Authorization rules in `Policies/`
- **DTO Pattern** — Typed data objects in `DTOs/`

## Related Documentation

- `docs/refactor/` — Codebase normalization progress and tracking
- `docs/i18n/` — Internationalization project tracking
