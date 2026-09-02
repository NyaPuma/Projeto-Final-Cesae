# resources/css/swagger

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Swagger UI custom theme that integrates the API documentation with the application's design system.

## Files

| File | Purpose |
|------|---------|
| `swagger-theme.css` | Complete redesign of Swagger UI: hides native elements, applies design system tokens to tags, method badges, forms, tables, code blocks, scrollbars, and error states. Supports light/dark mode. |

## Architecture

- All rules are prefixed with `:root .swagger-ui` for absolute specificity.
- Zero inline styles — everything is in this file.
- HTTP method badges use distinct colors: GET (green), POST (indigo), PUT (amber), DELETE (red), PATCH (teal).
- Dark mode is triggered via `.dark` / `[data-theme='dark']` selectors on parent elements.
- Consumes design tokens from `theme/variables.css` (`--surface`, `--border`, `--primary`, `--text`, etc.).

## Recent Refactorings

- `swagger-theme.css`: No changes needed — already uses design tokens throughout. HTTP method badge colors remain hardcoded intentionally (Swagger semantic palette with documented WCAG contrast ratios per value). All font sizes are at/above the `0.75rem` AA minimum.
