# resources/views/components

Reusable Blade components, organized by category under `ui/`.

| Item | Purpose |
|------|---------|
| `ui/` | Categorized Blade component library: analytics, auth, buttons, dashboard, equipments, form, listing, page-actions, partials, profile, rooms, text |

## Notes

- There are no `.blade.php` files at this level; all components live inside category folders under `ui/`.
- Most category folders contain their own `README.md`; use `<x-ui.<category>.<component>>` to render them.
