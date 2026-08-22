# `database/seeders/`

Database seeders for populating the application with initial and test data.

## Files

| File | Purpose |
|---|---|
| `ActivityFeedSeeder.php` | Seeds activity feed entries for demonstration. |
| `BulkOperationalDataSeeder.php` | Seeds large volumes of operational data (tickets, movements) for performance testing. |
| `DatabaseSeeder.php` | Master seeder that orchestrates all other seeders in dependency order. |
| `EquipmentCategoriesSeeder.php` | Seeds equipment categories (Robotics, Automation, Logistics, etc.). |
| `EquipmentsSeeder.php` | Seeds sample equipment records linked to categories and rooms. |
| `NotificationsSeeder.php` | Seeds sample notifications for test users. |
| `RoomsSeeder.php` | Seeds rooms with buildings, floors, and location codes. |
| `StockMovementSeeder.php` | Seeds stock movement records for parts. |
| `TicketLookupSeeder.php` | Seeds ticket statuses, types, and categories (the lookup/reference data). |
| `TicketsSeeder.php` | Seeds sample tickets with various statuses and assignments. |
| `UserPreferencesSeeder.php` | Seeds default user preferences (language, currency, date format). |
| `UsersSeeder.php` | Seeds users with profiles, roles (admin, technician, user). |

## Notes for developers / AI

- Seed data strings (names, descriptions, status labels) are in Portuguese as they represent user-facing domain data — pending i18n migration.
- `TicketsSeeder` and `UsersSeeder` have production guards that abort if `APP_ENV=production`.
- `DatabaseSeeder` should be the entry point (`php artisan db:seed`) — it calls other seeders in order.
- `BulkOperationalDataSeeder` is intended for development/staging only, not production.

## Related Folders

| Path | Relationship |
|---|---|
| `database/factories/` | Model factories used by seeders |
| `database/seeders/Data/` | Static data datasets (operational equipment, ticket templates) |
| `database/migrations/` | Schema that seeders populate |
| `app/Models/` | Models that seeders create instances of |
