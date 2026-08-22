# `routes/`

Laravel route definitions for the SGM application. Routes are split by transport layer.

## Files

| File | Purpose |
|---|---|
| `api.php` | API routes (JSON responses). Public routes for login/activities/password reset. Protected routes (via `custom.auth` middleware) for tickets, stock, admin CRUD, analytics, and notifications. |
| `web.php` | Web UI routes (Blade views). Public routes for home, login, and public ticket submission (QR code). Protected routes for the full web interface: tickets, equipment, rooms, stock, admin management, calendar, analytics, and settings. |
| `console.php` | Artisan console schedule. Defines recurring commands: hourly telemetry simulation, daily database backup at 02:00, and monthly audit partition management. |

## Notes for developers / AI

- **Middleware**: `custom.auth` handles both JWT token and session-based authentication. `role:admin`, `role:technician`, `role:admin,technician` are role-based access guards.
- **CSRF**: Many API-like web routes disable CSRF validation via `withoutMiddleware([ValidateCsrfToken::class])` — these are consumed by JavaScript fetch calls.
- **Rate limiting**: Applied to login, password reset, and test email routes.
- **Route names**: Prefixed by transport layer (`api.*` for API, no prefix for web). Route names are English throughout.
- **Route parameters**: Use English names (`{ticket}`, `{equipment}`, `{room}`, `{part}`, `{supplier}`, `{plan}`, `{taxRate}`, `{category}`).
- **Console schedule**: Requires Laravel cron to be configured (`php artisan schedule:run`).

## Related Folders

| Path | Relationship |
|---|---|
| `app/Http/Controllers/` | All route handlers |
| `app/Http/Middleware/` | Middleware referenced in routes |
| `app/Console/Commands/` | Artisan commands scheduled in console.php |
