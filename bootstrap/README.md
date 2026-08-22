# `bootstrap/`

Laravel application bootstrap configuration.

## Files

| File | Purpose |
|---|---|
| `app.php` | Application configuration: routing (web, API, console), middleware (locale, auth, security headers, rate limiting), scheduled jobs (low stock check), and exception handling. |
| `providers.php` | Service provider registration (AppServiceProvider, EventServiceProvider). |

## Notes for developers / AI

- `app.php` is the Laravel 11+ application bootstrap file — it configures routing, middleware, scheduling, and exception handling in a fluent API.
- Middleware aliases: `custom.auth` (JWT + session), `role` (role-based access), `rate.limit` (throttling).
- The `CheckLowStockJob` runs daily at 06:00 to check for low stock levels.
- Error pages resolve locale from the request to ensure proper language display.

## Related Folders

| Path | Relationship |
|---|---|
| `routes/` | Route files referenced by bootstrap |
| `app/Http/Middleware/` | Middleware classes registered here |
| `app/Providers/` | Service providers registered in providers.php |
| `app/Jobs/CheckLowStockJob.php` | Scheduled job for low stock alerts |
