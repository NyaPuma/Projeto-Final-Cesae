# resources/views/components/ui/partials

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Reusable partial components used as building blocks within larger page layouts.

## Files

| File | Purpose |
|---|---|
| `page-header.blade.php` | Structural page header (no card wrapper). Renders an optional animated badge, title, subtitle and an `actions` slot. Content sections go below via the default slot with `space-y-6` spacing. |

## Notes for developers / AI

- The `animate` prop controls the ping-animation on the badge dot — pass `false` to disable it.
- The `$actions` slot is only rendered when `isset($actions)` — use it to place action buttons aligned to the right on large screens.

## Recent Refactorings

- `page-header.blade.php`: Animated badge pulse dot moved from `amber-500` to the `warning` token (`bg-warning/50`, `bg-warning`) — auto-adapts in dark mode.
