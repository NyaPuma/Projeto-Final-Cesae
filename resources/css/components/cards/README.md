# resources/css/components/cards

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Card component base styles.

## Files

| File | Purpose |
|------|---------|
| `card-base.css` | Core card layout: flex column, background, border, border-radius, shadow, and transitions |

## Classes

- `.ui-card` — base card component with customizable properties via CSS variables (`--card-padding`, `--card-radius`, `--card-bg`, etc.)

## Conventions

- Card properties are defined as CSS custom properties at the component level, allowing per-instance overrides.
- All values reference design tokens from `theme/variables.css`.
