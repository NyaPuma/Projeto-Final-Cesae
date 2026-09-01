# Development Operations

## Local setup

Use the existing Composer setup command for a clean local environment:

```bash
composer setup
```

The Docker Compose stack is available through `docker-compose.yml` and requires the database credentials supplied in the local `.env` file. Never commit those credentials.

## Operational checks

```bash
composer docs:generate
php artisan backup:run --help
  CACHE_STORE=array php artisan schedule:list
vendor/bin/pint --test
vendor/bin/phpstan analyse
php artisan test
```

Configure `SENTRY_LARAVEL_DSN` to enable error tracking. Configure `BACKUP_OFFSITE_ENABLED=true`, `BACKUP_OFFSITE_DISK`, `BACKUP_OFFSITE_PATH`, and the provider credentials to enable private off-site backups. Keep `SENTRY_SEND_DEFAULT_PII=false` unless a documented privacy review approves a change.
