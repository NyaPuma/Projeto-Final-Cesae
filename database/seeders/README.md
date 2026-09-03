# `database/seeders/`

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md)

## What Is a Seeder? (plain English)

A **seeder** is a script that **fills the database with starting or reference data**. The migrations build the empty tables (the "shelves"), and the seeders are what put the "starter inventory" onto those shelves so that the app has meaningful data right away.

Seeders are used for two main purposes:
- **Reference data** — the fixed lists the app needs to function (e.g. ticket statuses like "open"/"closed", user roles, equipment categories).
- **Demo/operational data** — realistic sample data (users, rooms, equipment, tickets, stock) so that a fresh copy of the app looks alive for development and testing.

Below is what each seeder **fills** in plain English.

## Files — What Each Seeder Fills

| File | What it fills (plain English) |
|---|---|
| `DatabaseSeeder.php` | The **master seeder**. This is the *entry point* for `php artisan db:seed` — it calls the other seeders in the right order (so dependencies exist before dependent data is created). |
| `BulkOperationalDataSeeder.php` | An **orchestrator** that runs the core "bulk" seeders together: profiles, users, rooms, equipment categories, equipment, and tickets. |
| `UserProfilesSeeder.php` | The **user profiles/roles** — `admin`, `technician`, and `user`. |
| `UsersSeeder.php` | **Users** — a handful of default demo accounts (admin/technician/user with realistic passwords) plus ~30 synthetic users with a realistic mix of roles and active/inactive states. Refuses to run in production. |
| `RoomsSeeder.php` | **Rooms** — a few realistic rooms (assembly line, I&D lab, warehouse…) plus the full room catalogue and ~45 synthetic rooms with a realistic building/floor mixture and ~15% set inactive. |
| `EquipmentCategoriesSeeder.php` | **Equipment categories** — the four main real ones (Robotics, Automation, Infrastructure, Logistics) plus ~30 synthetic categories. |
| `EquipmentsSeeder.php` | **Equipment** — realistic machines (robotic arms, presses, servers, forklifts…) plus the full catalogue and ~40 synthetic items, with a realistic status mix (~80% operational, ~10% maintenance, ~5% broken, ~5% withdrawn). |
| `TicketLookupSeeder.php` | The **ticket lookup/reference data** — the ticket *types* (Hardware, Software, Network) and the *statuses* (open, in progress, awaiting parts, closed, cancelled, pending budget, declined, under review, no network). |
| `TicketsSeeder.php` | **Tickets** — ~60 realistic maintenance tickets with varied priorities and a realistic status mix (~85% final states, ~15% active). Refuses to run in production. |
| `StockDataSeeder.php` | The **stock/warehouse data** — VAT/tax rates, part categories, suppliers, spare parts, stock movements (in/out), and preventive maintenance plans linked to parts. |
| `ActivityFeedSeeder.php` | The **audit log / activity feed** — a realistic history of who did what (ticket, part, equipment, room changes), using a marker so it only seeds once. Refuses to run in production. |
| `NotificationSeeder.php` | **Notifications** — ~60 sample notifications for users, with realistic types, priorities, and read/unread states. Only seeds if notifications are empty. |

## How a Seeder Works (briefly)

- The **`DatabaseSeeder`** is the `php artisan db:seed` entry point — it calls the other seeders in dependency order: it starts with `TicketLookupSeeder` and `BulkOperationalDataSeeder`, then `StockDataSeeder`, `ActivityFeedSeeder`, and `NotificationSeeder`.
- Many seeders are **idempotent / safe to re-run** — they use `updateOrInsert`, `firstOrCreate`, or a "seed marker" check, so they don't create duplicates when run more than once.
- Several seeders contain a **production guard** — if `APP_ENV=production`, they abort with an error rather than adding demo/synthetic data to a live database.

## Notes for developers / AI

- Seed data strings (names, descriptions, status labels) are in **Portuguese** as they represent user-facing domain data — pending the i18n (translation) migration.
- `TicketsSeeder` and `UsersSeeder` have production guards that abort if `APP_ENV=production`.
- `DatabaseSeeder` should be the entry point (`php artisan db:seed`) — it calls the other seeders in order.
- `BulkOperationalDataSeeder` is intended for development/staging only, not production.

## Related Folders

| Path | Relationship |
|---|---|
| `database/factories/` | Model factories used by seeders to mass-produce records. |
| `database/seeders/Data/` | The static "recipe" data sets (operational equipment, ticket templates) that seeders read from. |
| `database/migrations/` | The schema (tables) that seeders populate. |
| `app/Models/` | The models that seeders create instances of. |
