# `database/seeders/Data/`

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md)

## What Is This Folder? (plain English)

This folder holds the **"recipe cards"** for the app's seeders — the static, hand-written lists of real-world values that the seeders copy into the database.

The seeders themselves (in `database/seeders/`) contain the *logic* for *how* to fill tables (e.g. "create 100 rooms with realistic statuses"). But the **actual real-world source material** — the real room names, the realistic equipment brands/models, the believable maintenance-ticket scenarios — lives here as tidy lists. Keeping these lists separate means the data is easy to read, update, and reuse, without burying it inside the seeding logic.

The data is **fictional but realistic** — it uses the real technical vocabulary of industrial maintenance (in European Portuguese), rather than random placeholder text, so demo data genuinely looks and behaves like the real thing.

## Files — What Each Provides

| File | What it provides (plain English) |
|---|---|
| `OperationalData.php` | One big, organised source of **realistic operational data**, exposed as small helper "catalogue" lists the seeders call on: <br>• **`rooms()`** — the realistic list of rooms across the industrial site (assembly lines, labs, warehouses, server rooms, workshops…) with their building and floor. <br>• **`equipmentCatalog()`** — the realistic equipment catalogue (robotic arms, presses, CNC machines, compressors, servers…) with names, brands, models, serials, weights, and descriptions. <br>• **`ticketScenariosByCategory()`** — the believable maintenance scenarios used to generate realistic tickets for each equipment category. <br>• **`partsByCategory()`** — the realistic spare parts grouped by category. <br>• **`technicianNames()`** / **`reporterNames()`** — realistic Portuguese first/last names used for synthetic technicians and reporters. |
| `TicketDataset.php` | A **ticket generator** that produces a coherent set of ~1,500 synthetic maintenance tickets, following fixed realistic rules — Pareto distribution across equipment, SLA calculated from open/close times, costs consistent with labour, weighted priorities/statuses/sources, and a spread across the last six months. |

## Notes for developers / AI

- Data strings are in **Portuguese** as they represent user-facing domain data — pending the i18n (translation) migration.
- `OperationalData` equipment **weights** help decide which equipment gets more tickets (some items realistically break more often).
- `TicketDataset` templates include realistic maintenance scenarios for the SGM (maintenance-management) domain.

## Related Folders

| Path | Relationship |
|---|---|
| `database/seeders/` | The seeders that consume this data. |
| `database/factories/` | The factories that create model instances from this data. |
