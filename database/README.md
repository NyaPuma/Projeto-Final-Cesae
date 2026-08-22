# `database/`

Database layer for the SGM Laravel application: schema migrations, seeders, and model factories.

## Directory Structure

| Directory | Purpose |
|---|---|
| `factories/` | Eloquent model factories for generating test/seed data |
| `migrations/` | Database schema migrations (do not rename — Laravel tracks by filename) |
| `seeders/` | Database seeders for initial and demo data |
| `seeders/Data/` | Static datasets consumed by seeders |

## Notes for developers / AI

- Migration filenames and class names are **excluded from renaming** — Laravel's `migrations` table tracks applied migrations by filename.
- Seed data strings (status names, category names, equipment names) are in Portuguese as user-facing domain data — pending i18n migration.
- `DatabaseSeeder` is the entry point for `php artisan db:seed`.
- `PartitionAudits` command manages MySQL RANGE partitioning for the `audits` table.

## Related Folders

| Path | Relationship |
|---|---|
| `app/Models/` | Eloquent models mapping to these tables |
| `app/Console/Commands/` | Commands that manage partitions and backups |
