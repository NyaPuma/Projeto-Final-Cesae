# resources/views/components/ui/auth

Blade components for authentication and secure-area layouts. These form the visual foundation for login, registration and password reset pages.

## Files

| File | Purpose |
|---|---|
| `form-header.blade.php` | Modular page header with eyebrow label, large title and description. Used at the top of auth forms. |
| `message.blade.php` | Dynamic message/alert container with `aria-live="polite"` for accessible feedback (success, error). Visibility toggled via JS. |
| `password-field.blade.php` | Password input with optional Alpine.js-powered visibility toggle. Supports `old()` value preservation and ID deduplication. |
| `shell.blade.php` | Full-page auth layout with a two-column grid: an informational side panel (eyebrow, title, description, highlights) and a centered form slot. Includes theme meta, locale config, and background glow effects. |
| `submit-button.blade.php` | Primary submit button with a right-arrow icon and hover translate animation. Wraps `x-ui.buttons.submit`. |
| `text-field.blade.php` | Standard text input wrapper with label, type, autocomplete, placeholder and `old()` value support. Wraps `x-ui.form.field` + `x-ui.form.input`. |

## Notes for developers / AI

- `shell.blade.php` is a full HTML document (doctype, head, body) — it does not extend a layout. It includes `ui.partials.theme-meta`, `ui.partials.locale-config`, `ui.partials.locale-trigger`, and `ui.partials.locale-modal`.
- `password-field.blade.php` supports both `$toggleLabel`/`$hideLabel` (camelCase) and `$toggle_label` (snake_case) prop names for backward compatibility.
- All user-facing strings use `__()` translation calls or are passed as props.

## Recent Refactorings

- `shell.blade.php`: Decorative glow `blue-500/10` → `info` token; description typography `sm:text-[15px]` → `sm:text-base` (design-token size).
- `form-header.blade.php`, `message.blade.php`, `password-field.blade.php`, `submit-button.blade.php`, `text-field.blade.php`: no markup changes — already token- and component-based (`x-ui.form.*`, `x-ui.buttons.*`, design-token utilities).
