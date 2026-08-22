# `app/Console/Commands`

Artisan console commands for database maintenance, data repair, and telemetry simulation.

## Files

| File | Purpose |
|---|---|
| `DatabaseBackup.php` | Creates database backups using native tools (mysqldump/sqlite3). Supports gzip compression and old backup cleanup via retention policy. |
| `FixTicketEncoding.php` | Repairs ticket records with Mojibake (double-encoded latin1/utf8mb4). Byte-precise detection avoids false positives. MySQL-only. |
| `PartitionAudits.php` | Creates and drops RANGE partitions on the `audits` table. Manages future partitions and prunes old ones based on retention months. MySQL/MariaDB only. |
| `SimulateTelemetry.php` | Simulates equipment telemetry and auto-generates preventive maintenance tickets when anomalies are detected. Configurable probability and equipment count. |

## Notes for developers / AI

- All commands extend Laravel's `Illuminate\Console\Command`.
- `DatabaseBackup` supports MySQL and SQLite drivers; others are rejected at runtime.
- `PartitionAudits` and `FixTicketEncoding` are MySQL-specific and will fail gracefully on other drivers.
- `SimulateTelemetry` uses `TicketStatusService` to resolve status IDs and creates tickets in a DB transaction.
- CLI option descriptions and output strings are user-facing (i18n domain) and remain in Portuguese pending the i18n migration.
- All commands support `--dry-run` where applicable for safe testing.

## Related Folders

| Path | Relationship |
|---|---|
| `app/Services/TicketStatusService` | Status name resolution used by SimulateTelemetry |
| `app/Models/Equipment` | Equipment model queried by SimulateTelemetry |
| `app/Models/Ticket` | Ticket model created by SimulateTelemetry |
| `app/Enums/TicketStatusEnum` | Status enum used by SimulateTelemetry |
