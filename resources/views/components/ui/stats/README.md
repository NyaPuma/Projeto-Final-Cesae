# resources/views/components/ui/stats

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Shared statistical / KPI card components used on entity detail pages.

## Files

| File | Purpose |
|---|---|
| `stat-card.blade.php` | Compact KPI card: label, optional icon, value (slot, `text-2xl`), optional sublabel and tone (`warning`/`info`/`danger`/`success`). Used by `ui/equipments/show.blade.php` and `ui/rooms/show.blade.php`. |

## Notes for developers / AI

- The component is the single source for the KPI card style (`rounded-2xl border bg-[var(--surface)] p-4 shadow-sm`, `text-2xl` value). Do not hand-roll KPI cards on detail pages.
- The icon prop accepts a raw inline SVG string (Heroicons outline convention used app-wide) — pass it with the `:icon="..."` (colon) syntax so it is not HTML-escaped.
- `tone` only colours the value; pass `icon-class` (e.g. `text-warning`/`text-danger`) to colour the icon independently.

## Recent Refactorings

- `stat-card.blade.php` (NEW): unifies the KPI grid of `ui/equipments/show.blade.php` (reference, `p-4`/`text-2xl`) and `ui/rooms/show.blade.php` (which had temporarily been enlarged to `p-5`/`text-3xl` — that bump was reverted to align both pages).