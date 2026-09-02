# `database/`

This folder is the **"filing cabinet" (storeroom)** of the whole SGM application. Every single piece of information the system keeps — who the users are, which rooms exist, what equipment is installed, every maintenance ticket, every spare part in stock — lives in a **database** (a very organised, searchable collection of tables). The `database/` folder is where the app defines *what* gets stored in that cabinet and *how* it is filled with data.

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "The Blueprint Room" containing architectural blueprints for the database, test data generators, and starter data.

## The Three Helpers Inside (in plain English)

The `database/` folder contains three sub-folders, each with a very different job:

| Folder | Nickname | What it does | When it's used |
|---|---|---|---|
| `factories/` | **The "fake data machines"** | A factory is a machine that automatically generates realistic, made-up records (fake users, fake tickets, fake spare parts) so that the app can be tested without touching real data. | During automated tests and to help seeders create many records quickly. |
| `migrations/` | **The "blueprint builders"** | A migration is a set of instructions that *build the shelves* of the cabinet — it creates the actual tables and decides which columns each table has. Migrations are versioned, so the database can be built and upgraded step by step. | Every time the database structure is created or changed (`php artisan migrate`). |
| `seeders/` | **The "moving-in helpers"** | A seeder fills an empty table with starting or reference data — for example the list of ticket statuses ("open", "in progress", "closed"), or a set of demo users and equipment so the app has something to show on day one. | When setting up a fresh database, or running demo data (`php artisan db:seed`). |

Inside `seeders/` there is also a small sub-folder called **`Data/`**, which holds the "recipe cards" — the static, hand-written lists of real-world values (room names, equipment names, ticket templates) that the seeders read and copy into the database.

## How It Works Together (the whole picture)

Think of setting up a brand-new copy of the app as moving into an empty building:

1. **Migrations build the room** — they create the empty tables and decide exactly what each column will hold (like installing the shelves and labelling them).
2. **Factories help produce inventory** — when we need lots of sample records, factories quickly generate realistic fake ones.
3. **Seeders move the starter furniture in** — they run and put the initial, meaningful data (statuses, demo users, sample equipment) into those freshly built tables.
4. **The app reads and writes from there** — from then on, the normal application keeps working against the fully built and populated database.

## Notes for developers / AI

- **Migration filenames and class names are excluded from renaming** — Laravel's `migrations` table keeps track of which migrations have already been applied *by filename*. Renaming a file would "forget" that a migration already ran and break the history. Never rename them.
- Seed data strings (status names, category names, equipment names) are in **Portuguese** because they are user-facing domain data — this is awaiting a future i18n (translation) migration.
- `DatabaseSeeder` is the entry point for `php artisan db:seed` — it decides which sub-seeders run and in what order.
- `PartitionAudits` command manages MySQL RANGE partitioning for the `audits` table (splitting a very large table into smaller, faster chunks).

## Related Folders

| Path | Relationship |
|---|---|
| `app/Models/` | The code "mirrors" of these tables — each table has a corresponding Model that the app uses to read/write data. |
| `app/Console/Commands/` | Commands (like `PartitionAudits`) that manage large tables and backups. |
