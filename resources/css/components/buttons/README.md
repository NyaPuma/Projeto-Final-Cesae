# resources/css/components/buttons

Button component styles, split into base mechanics and visual variants.

## Files

| File | Purpose |
|------|---------|
| `button-base.css` | Core button structure: sizing, spacing, states (hover, active, focus, disabled, loading), sizes (xs through xl), icon/label/spinner internals |
| `button-variants.css` | Color and theme variants: primary, secondary, outline, ghost, success, warning, danger |

## Architecture

- **`button-base.css`** defines CSS custom properties (`--button-bg`, `--button-color`, etc.) with sensible defaults, then applies them via `.ui-button`.
- **`button-variants.css`** overrides those custom properties per variant class (e.g., `.ui-button--primary` sets `--button-bg: var(--primary)`).
- Both files are wrapped in `@layer components` for proper Tailwind v4 layer ordering.

## Classes

- `.ui-button` — base button
- `.ui-button--primary`, `.ui-button--secondary`, `.ui-button--outline`, `.ui-button--ghost` — theme variants
- `.ui-button--success`, `.ui-button--warning`, `.ui-button--danger` — semantic variants
- `.ui-button--xs` through `.ui-button--xl` — size modifiers
- `.ui-button--block` — full width
- `.ui-button--rounded` — pill shape
- `.ui-button.is-loading` — loading state with spinner
