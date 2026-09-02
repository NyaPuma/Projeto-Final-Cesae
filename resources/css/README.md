# resources/css

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md)

Root directory for the application's CSS design system. All styles are defined using CSS custom properties (design tokens) and organized into logical layers.

## Files

| File | Purpose |
|------|---------|
| `app.css` | Entry point — imports all other CSS files and configures Tailwind v4 source scanning |
| `tokens.css` | Design tokens: colors, typography, spacing, radii, shadows, transitions, layout metrics |
| `base.css` | Reset and base element styles (html, body, headings, focus, etc.) |
| `layout.css` | Page shell structure (app-shell, page-wrapper, sidebar, background effects) |
| `rtl.css` | Right-to-left (RTL) layout support overrides |

## Subdirectories

| Directory | Purpose |
|-----------|---------|
| `base/` | (Reserved for future base-level utilities) |
| `components/` | Component-level styles (buttons, cards, forms, navigation, sidebar, badges, modals) |
| `pages/` | Page-specific styles (calendar, tickets, login, settings, listing) |
| `swagger/` | Swagger UI custom theme integrating with the design system |
| `theme/` | Semantic alias layer bridging design tokens to component-level variables |

## Architecture

1. **`tokens.css`** defines all raw values as `--color-*`, `--space-*`, `--radius-*`, etc.
2. **`theme/variables.css`** creates semantic aliases (`--primary`, `--text`, `--surface`, etc.) that reference tokens.
3. **`tokens.css` `@theme inline`** block bridges tokens to Tailwind v4 utilities (`bg-primary`, `rounded-xl`, etc.).
4. Component and page CSS files consume these variables — never hardcode values.
5. **`app.css`** imports everything in the correct order and scans Blade/JS files for Tailwind classes.

## Conventions

- All colors, spacing, and radii use CSS custom properties from `tokens.css`.
- Dark mode is handled via `.dark` / `[data-theme='dark']` selectors.
- Comments are written in English.
- No inline styles — all CSS lives in this directory structure.

## Recent Refactorings

- **`app.css`**: No changes needed — pure import manifest.
- **`base.css`**: No changes needed — clean reset using CSS tokens.
- **`layout.css`**: Removed unused `--layout-max-width` variable (duplicate of `--content-width`). Replaced hardcoded `box-shadow` on `.skip-link:focus-visible` with `var(--shadow-md)`.
- **`rtl.css`**: Removed dead `.ui-topbar__dropdown-panel` RTL rule (dropdown approach was abandoned).
- **`tokens.css`**: Added missing `--radius-3xl` and `--radius-round` to `@theme inline` block so they're available as Tailwind v4 utilities (`rounded-3xl`, `rounded-full`).
