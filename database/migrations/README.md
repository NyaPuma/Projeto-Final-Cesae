# `database/migrations/`

Laravel database migrations defining the SGM schema. Migration filenames and class names are preserved as-is (renaming breaks `migrate:status` and rollback history per §3).

## Key Migrations

| File | Purpose |
|---|---|
| `0001_01_01_000001_create_users_table.php` | Users, sessions, refresh tokens, email verification, password reset. |
| `0001_01_01_000002_create_tickets_table.php` | Tickets, statuses, types, comments, workflow history. |
| `0001_01_01_000003_create_rooms_table.php` | Rooms with building/floor/location and soft deletes. |
| `0001_01_01_000004_create_equipment_table.php` | Equipment with categories, rooms, and asset tags. |
| `0001_01_01_000005_create_stock_table.php` | Parts, suppliers, stock movements, tax rates, part categories. |
| `0001_01_01_000006_create_audits_table.php` | Audit trail with partitioning support (MySQL RANGE). |
| `0001_01_01_000007_create_maintenance_plans_table.php` | Preventive maintenance plans with part associations. |
| `0001_01_01_000008_create_ticket_attachments_table.php` | File attachments for tickets. |
| `0001_01_01_000009_create_ticket_comments_table.php` | Comments on tickets (with internal flag and threading). |
| `2026_07_09_100000_create_notifications_table.php` | User notifications with priority and expiration. |
| `2026_08_12_000001_create_user_preferences_table.php` | User locale preferences (language, currency, date format). |
| `2026_08_12_000002_populate_user_preferences.php` | Data migration: populates defaults for existing users. |
| `2026_08_12_000003_add_number_format_to_user_preferences.php` | Adds number_format column to user_preferences. |

## Notes for developers / AI

- **Do not rename migration files or classes** — Laravel tracks applied migrations by filename.
- Comments within migrations have been translated to English.
- The `audits` table supports MySQL RANGE partitioning (managed by `PartitionAudits` command).
- Data migrations (`populate_user_preferences`) are reversible with sensible rollback logic.

## Related Folders

| Path | Relationship |
|---|---|
| `app/Models/` | Eloquent models mapping to these tables |
| `database/seeders/` | Seeders populating these tables |
| `database/factories/` | Factories creating test data |
| `app/Console/Commands/PartitionAudits.php` | Manages audit table partitions |
