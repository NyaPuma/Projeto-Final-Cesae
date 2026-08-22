# `database/seeders/Data/`

Static data datasets used by seeders for populating the database with realistic operational data.

## Files

| File | Purpose |
|---|---|
| `OperationalData.php` | Defines equipment data organized by category (Robotics, Automation, Infrastructure, Logistics) with names, brands, models, serial numbers, weights, and descriptions. |
| `TicketDataset.php` | Defines ticket templates with titles, descriptions, priorities, and resolution data for generating realistic maintenance tickets. |

## Notes for developers / AI

- Data strings are in Portuguese as they represent user-facing domain data — pending i18n migration.
- `OperationalData` equipment weights determine priority distribution in ticket generation.
- `TicketDataset` templates include realistic maintenance scenarios for the SGM domain.

## Related Folders

| Path | Relationship |
|---|---|
| `database/seeders/` | Seeders that consume this data |
| `database/factories/` | Factories that create model instances from this data |
