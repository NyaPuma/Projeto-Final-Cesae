# resources/css/components

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Component-level CSS styles. Each file targets a specific UI component or group of related components.

## Files

| File | Purpose |
|------|---------|
| `forms.css` | Form components: field, label, control, select, textarea, help/error text, color swatch |
| `badges.css` | Status and priority badges for ticket states (open, in-progress, resolved, urgent, neutral) |
| `navigation.css` | Sidebar, mobile nav, and topbar component styles |
| `sidebar.css` | Desktop sidebar collapse animations and anti-flash pre-collapsed state |
| `locale-modal.css` | Language/region selector modal with glassmorphism, search, flag grid, and preview bar |
| `localization-modal.css` | Localization modal tabs and panels |

## Subdirectories

| Directory | Purpose |
|-----------|---------|
| `buttons/` | Button component: base styles, sizes, states, and color/theme variants |
| `cards/` | Card component: base layout and styling |

## Conventions

- All component CSS consumes variables from `theme/variables.css` — never hardcodes color or spacing values.
- BEM-like naming: `.block__element--modifier` (e.g., `.locale-modal__card--active`).
- Dark mode overrides use `.dark` or `[data-theme='dark']` selectors.
- `@layer components` is used in button files for Tailwind v4 layer ordering.

## Recent Refactorings

- **`navigation.css`**: Replaced hardcoded `--text-xs`, shadow `rgba(15, 23, 42, …)`, and dark-mode badge hex `#b91c1c` with design tokens (`var(--text-xs)`, `rgba(var(--shadow-base-rgb), …)`, `var(--danger)`). Notifications modal padding/gap values now use the spacing scale (`var(--space-*)`).
- **`sidebar.css`**: Replaced hardcoded `5rem`, `0.5rem`, `1rem` collapsed-sidebar values with the new `var(--sidebar-collapsed-width)` token and `var(--space-2)`/`var(--space-4)`.
- **`locale-modal.css`**: Replaced hardcoded pixel/rem font sizes with the typography scale (`var(--text-xs)`, `var(--text-sm)`, `var(--text-lg)`, `var(--text-xl)`), keeping the `0.75rem` minimum for AA readability.
- **`tokens.css`**: Added `--sidebar-collapsed-width: 5rem` layout token.
- `button-base.css`, `button-variants.css`, `card-base.css`, `badges.css`, `forms.css`, `localization-modal.css`: No changes needed — already token-based.
