# resources/views/components/card

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Design-system card primitives (top-level aliases `<x-card.card>`, `<x-card.badge>`, `<x-card.alert>`).

## Files

| File | Purpose |
|---|---|
| `card.blade.php` | Generic card container (`ui-card`) with an optional link state (`href` → anchor) and a loading skeleton state (`ui-card--loading` + `ui-card-skeleton`, `aria-busy="true"`). |
| `badge.blade.php` | Small label/chip (`ui-card-badge--{variant}`) with optional `dot` (`ui-card-badge--has-dot`) and `pill` (`ui-card-badge--pill`) treatments. |
| `alert.blade.php` | Contextual alert (`ui-card-alert--{variant}`) with optional `title` (rendered as `ui-card-alert__title`) and body slot, `role="alert"`. |

These class hooks are asserted by `tests/Feature/Web/Views/DesignSystemComponentsTest.php`.
