# `app/Providers`

Laravel service providers for bootstrapping application services, registering bindings, and wiring events.

## Files

| File | Purpose |
|---|---|
| `AppServiceProvider.php` | Main service provider. Registers repository bindings (interfaces → concrete classes), singleton services, authorization policies, model observers, Blade formatting directives (`@money`, `@number`, `@date`, etc.), and a slow query listener. |
| `EventServiceProvider.php` | Defines the event-to-listener mapping. Maps `TicketCreated`, `TicketStatusChanged`, and `TicketStatusUpdatedBroadcast` events to their respective listeners. Auto-discovery is disabled for performance. |

## Notes for developers / AI

- `AppServiceProvider` is the central wiring point — new repository bindings, services, policies, or observers should be added here.
- `EventServiceProvider` uses explicit mapping (not auto-discovery) — add new event/listener pairs to the `$listen` array.
- Blade directives (`@money`, `@number`, `@percent`, `@date`, `@datetime`, `@localized*`) delegate to `LocalizationService` for locale-aware formatting.
- The slow query listener is gated by the `database.connections.mysql.slow_query_log` config flag.

## Related Folders

| Path | Relationship |
|---|---|
| `app/Repositories/` | Concrete repositories bound by AppServiceProvider |
| `app/Repositories/Contracts/` | Interface contracts bound by AppServiceProvider |
| `app/Services/` | Singleton services registered by AppServiceProvider |
| `app/Models/` | Models with policies and observers registered here |
| `app/Policies/` | Authorization policies registered here |
| `app/Observers/` | Model observers registered here |
| `app/Events/` | Events mapped in EventServiceProvider |
| `app/Listeners/` | Listeners mapped in EventServiceProvider |
