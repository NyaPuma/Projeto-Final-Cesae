# resources/css/theme

Semantic alias layer that bridges raw design tokens to component-level CSS variables.

## Files

| File | Purpose |
|------|---------|
| `variables.css` | Defines semantic aliases (`--primary`, `--text`, `--surface`, `--border`, `--success`, etc.) that reference `--color-*` tokens from `tokens.css`. Also includes dark mode overrides for RGB values and topbar transparency. |

## Purpose

This file acts as an intermediary:
1. `tokens.css` defines raw values (e.g., `--color-primary: #ea580c`).
2. `variables.css` creates semantic shortcuts (e.g., `--primary: var(--color-primary)`).
3. Components consume these semantic aliases — never raw tokens directly.

This allows the custom theme system (settings page) and dark mode to override values at the token level, and have all components update automatically.

## Aliases Defined

| Category | Aliases |
|----------|---------|
| Brand | `--primary`, `--primary-hover`, `--primary-light`, `--on-primary` |
| Text | `--text`, `--text-primary`, `--text-soft`, `--text-muted` |
| Surfaces | `--background`, `--bg`, `--surface`, `--surface-2`, `--surface-3`, `--surface-hover` |
| Borders | `--border`, `--border-strong`, `--border-color`, `--border-hover` |
| States | `--success`, `--warning`, `--danger`, `--info` (plus `-hover`, `-light`, `-text`, `-rgb` variants) |
| Layout | `--sidebar`, `--topbar`, `--space-xs` through `--space-xl` |

## Recent Refactorings

- `variables.css`: No changes needed — the semantic alias layer is already token-based by design.
- `accessibility.css`: No changes needed — color-blind palette overrides use deliberately hardcoded colors to control exact luminance ratios (documented with per-value luminance comments).
