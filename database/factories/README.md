# `database/factories`

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md)

## What Is a Factory? (plain English)

A **factory** is like a little **machine that stamps out realistic fake records** for you. Instead of typing out a hundred users or tickets by hand, a factory knows the "recipe" for a believable record and can produce as many as you ask for — with realistic names, emails, statuses, and values every time.

Why do we need fake data? Because the app's test suite needs to run against a database that looks and behaves like a real one, **without** polluting real data. A factory gives the tests (and some seeders) a fast, realistic supply of records on demand.

Each factory here belongs to one table/model in the app. Below is what each one **produces** in plain English.

## Files — What Each Factory Produces

| File | What it produces (plain English) |
|---|---|
| `EquipmentCategoryFactory.php` | **Equipment categories** — the "buckets" that group equipment, e.g. electrical, hydraulic, robotics. |
| `EquipmentFactory.php` | **Equipment records** — the actual machines/devices, each linked to a room, a category, and given an asset tag (a unique ID sticker). |
| `MaintenancePlanFactory.php` | **Preventive maintenance plans** — schedules that say "service this machine every X days/hours", including which spare parts are needed. |
| `PartCategoryFactory.php` | **Part categories** — the groups spare parts fall into, e.g. electrical components, seals. |
| `PartFactory.php` | **Spare parts** — individual items kept in stock, each with a SKU (stock code), a supplier, current stock levels, and a storage location. |
| `RoomFactory.php` | **Rooms** — physical spaces (with names and floor assignments) where equipment lives. |
| `StockMovementFactory.php` | **Stock movements** — records that a part went *in* to stock, *out* of stock, was adjusted, or returned, with quantities and costs. |
| `SupplierFactory.php` | **Suppliers** — the companies that provide the spare parts, with NIF (tax number), contact details, and a rating. |
| `TaxRateFactory.php` | **VAT/tax rates** — the different tax percentages (e.g. 0%, 6%, 13%, 23%) applied to part prices. |
| `TicketAttachmentFactory.php` | **Ticket attachments** — the files/photos users attach to a maintenance ticket. |
| `TicketCommentFactory.php` | **Ticket comments** — the notes team members leave on a ticket. |
| `TicketFactory.php` | **Tickets** — the maintenance "jobs" themselves, with statuses, priorities, the affected equipment, and the people involved. |
| `TicketStatusFactory.php` | **Ticket statuses** — the possible states of a ticket (open, in progress, resolved, closed, etc.). |
| `TicketTypeFactory.php` | **Ticket types** — the broad categories a ticket belongs to (e.g. Hardware, Software, Network). |
| `UserFactory.php` | **Users** — the people who log into the app, with a profile, a role, and authentication data (password, token). |
| `UserProfileFactory.php` | **User profiles** — the role "levels" a user can belong to (admin, technician, regular user). |

## How a Factory Works (briefly)

Factories follow Laravel's standard patterns:

- **`define()`** — provides the "default recipe" the machine uses for every record.
- **`state()`** — lets you tweak one-off records (e.g. "make this one inactive").
- **`sequence()`** — cycles through a list of values so generated records vary (e.g. assigning different statuses in turn).

Many factories also reach out to *other* factories to build linked records — for example `TicketFactory` uses `UserFactory` and `RoomFactory` so that each generated ticket automatically gets realistic users and a room to belong to.

## Notes for developers / AI

- Factory seed data strings (status names, category names, location names) are in **Portuguese** because they represent user-facing domain data that will later be handled by the i18n (translation) project.
- All factories follow Laravel's standard `define()` / `state()` / `sequence()` patterns.
- Some factories reference related models (e.g., `TicketFactory` uses `UserFactory`, `RoomFactory`), so related tables must exist first.

## Related Folders

| Path | Relationship |
|---|---|
| `database/seeders/` | Seeders that use these factories to mass-produce records. |
| `database/migrations/` | The database schema (tables) these factories populate. |
| `app/Models/` | The models these factories create instances of. |
| `tests/` | The test files that use these factories. |
