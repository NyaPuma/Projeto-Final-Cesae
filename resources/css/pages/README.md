# resources/css/pages

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Page-specific CSS styles. Each file targets a single page or closely related set of pages.

## Files

| File | Purpose |
|------|---------|
| `calendar.css` | FullCalendar integration: toolbar, grid, day cells, differentiated event cards (preventive, past, intervention), side-by-side timegrid overlap handling, popover modal, equipment search autocomplete |
| `tickets.css` | Tickets listing and management page styles (budget items) |
| `login.css` | Login page background grid pattern |
| `definicoes.css` | Theme settings page: breadcrumbs, panels, presets grid, color palette, preview cards, status badges, typography |
| `sistema-definicoes.css` | System settings page (admin): stats header, groups, fields, toggle switches, save state indicator |
| `listing.css` | Mobile enhancements for listing pages: tables-as-cards, full-width action buttons, sticky pagination bar |

## Conventions

- Page CSS is scoped to the page's root class (e.g., `.fc` for FullCalendar, `.theme-settings__` for theme settings).
- Responsive rules use the same breakpoint as the sidebar (max-width: 1023px).
- All colors and spacing reference design tokens — no hardcoded values.

## Recent Refactorings

- **`calendar.css`**: Raised event-time label (`0.6875rem`) and equipment-search room label (`0.625rem`) to `var(--text-xs)` — both were below the `0.75rem` WCAG AA minimum.
- **`listing.css`**: Converted hardcoded spacing to tokens (`var(--space-*)`), `0.75rem` label font size to `var(--text-xs)`, hardcoded `1rem`/`-1rem` border-radius to `var(--radius-lg)`/`calc(var(--space-4) * -1)`.
- **`definicoes.css`**: Converted `0.5rem`/`0.75rem`/`0.25rem` spacing values to `var(--space-*)`. Replaced hardcoded shadows (`rgba(15, 23, 42, …)`) and urgent badge background (`rgba(220, 38, 38, 0.08)`) with token-based equivalents.
- **`sistema-definicoes.css`**: Group icon `font-size: 1.35rem` → `var(--text-2xl)`; heading margin to spacing tokens.
- `login.css`, `tickets.css`: No changes needed — already token-based.
