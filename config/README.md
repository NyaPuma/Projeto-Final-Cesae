# `config/`

Laravel configuration files for the SGM application.

## Files

| File | Purpose |
|---|---|
| `app.php` | Application name, locale (`pt-PT` default), timezone, service providers, aliases. |
| `auth.php` | Authentication guards (web, API) and provider configuration. |
| `backup.php` | Database backup settings: connection, destination path, compression, retention, excluded tables. |
| `broadcasting.php` | Broadcasting driver configuration (Pusher/Reverb). |
| `cache.php` | Cache store configuration (database, Redis, file). |
| `database.php` | Database connections (MySQL, SQLite), migration settings. |
| `filesystems.php` | Filesystem disks (local, public, S3) and visibility settings. |
| `hashing.php` | Password hashing driver (bcrypt/argon2). |
| `l5-swagger.php` | L5-Swagger/OpenAPI documentation settings, route middleware, UI theme. |
| `locales.php` | Supported locales with language names, currencies, and continental groupings. |
| `logging.php` | Log channels (stack, daily, slack, papertrail). |
| `mail.php` | Mail driver, from address, Markdown theme. |
| `openai.php` | OpenAI API configuration for AI-powered features. |
| `queue.php` | Queue connections (database, Redis, SQS) and failed job settings. |
| `sanctum.php` | Laravel Sanctum token configuration. |
| `services.php` | Third-party service credentials (mail, SMS, etc.). |
| `services.custom.php` | Custom service configuration overrides. |
| `session.php` | Session driver, lifetime, encryption, and cookie settings. |

## Notes for developers / AI

- `locales.php` contains language display names in their native scripts (user-facing, i18n domain) — these are intentionally in various languages.
- `l5-swagger.php` title includes the app name `Gestão de Avarias` — user-facing, pending i18n migration.
- `backup.php` is a custom config file (not Laravel default) for the `DatabaseBackup` artisan command.
- `services.custom.php` is loaded alongside `services.php` for environment-specific overrides.
- Config values use `env()` helpers with sensible defaults for development.

## Related Folders

| Path | Relationship |
|---|---|
| `app/Console/Commands/` | Commands that read backup and telemetry config |
| `app/Providers/` | Service providers that consume config values |
| `app/Services/` | Services reading OpenAI, mail, and locale config |
| `routes/console.php` | Scheduler referencing backup and telemetry commands |
