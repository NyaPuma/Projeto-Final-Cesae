# `database/factories`

Eloquent model factories for generating test/seed data.

## Files

| File | Purpose |
|---|---|
| `EquipmentCategoryFactory.php` | Generates equipment categories (e.g., electrical, hydraulic). |
| `EquipmentFactory.php` | Generates equipment records with rooms, categories, and asset tags. |
| `MaintenancePlanFactory.php` | Generates preventive maintenance plans with intervals and parts. |
| `NotificationFactory.php` | Generates user notifications with types and priorities. |
| `PartCategoryFactory.php` | Generates part categories (e.g., electrical components, seals). |
| `PartFactory.php` | Generates parts with SKUs, suppliers, stock levels, and locations. |
| `RoomFactory.php` | Generates rooms with names and floor assignments. |
| `StockMovementFactory.php` | Generates stock movements (entries/exits) with quantities and costs. |
| `SupplierFactory.php` | Generates suppliers with NIF, contact info, and ratings. |
| `SystemSettingFactory.php` | Generates system setting key-value pairs. |
| `TaxRateFactory.php` | Generates VAT/tax rates with percentages. |
| `TicketAttachmentFactory.php` | Generates ticket file attachments. |
| `TicketCommentFactory.php` | Generates ticket comments. |
| `TicketFactory.php` | Generates tickets with statuses, priorities, equipment, and users. |
| `TicketStatusFactory.php` | Generates ticket statuses (open, in progress, resolved, etc.). |
| `UserFactory.php` | Generates users with profiles, roles, and authentication data. |

## Notes for developers / AI

- Factory seed data strings (status names, category names, location names) are in Portuguese as they represent user-facing domain data that will be handled by the i18n project.
- All factories follow Laravel's standard `define()` / `state()` / `sequence()` patterns.
- Some factories reference related models (e.g., `TicketFactory` uses `UserFactory`, `RoomFactory`).

## Related Folders

| Path | Relationship |
|---|---|
| `database/seeders/` | Seeders that use these factories |
| `database/migrations/` | Database schema these factories populate |
| `app/Models/` | Models these factories create instances of |
| `tests/` | Test files that use these factories |
