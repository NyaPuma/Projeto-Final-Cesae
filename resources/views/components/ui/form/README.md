# resources/views/components/ui/form

Low-level form field Blade components. These are the building blocks used by all form-based views in the application.

## Files

| File | Purpose |
|---|---|
| `card.blade.php` | Generic card/container with optional header (title, description, icon) and a `danger` tone variant for destructive-action zones. |
| `field.blade.php` | Form field wrapper that renders a label (with required asterisk + screen-reader text) and manages spacing around the input slot. |
| `input.blade.php` | Standard text input with `old()` value restoration, autocomplete, placeholder, and Design System CSS classes. |
| `message.blade.php` | Semantic helper/description/error text container positioned below form fields. |
| `select.blade.php` | Standard select dropdown integrated with the Design System. Options are passed via the default slot. |

## Notes for developers / AI

- `field.blade.php` uses `__('validation.obrigatorio')` for the screen-reader required indicator — this is an i18n key, not a hardcoded string.
- `input.blade.php` uses `old()` for Laravel session-based form value preservation.
- All components merge `$attributes` for class/style passthrough from parent components.

## Recent Refactorings

- `card.blade.php`: `danger` tone migrated to design tokens — `border-danger/20 bg-danger/5` (auto dark-mode) and icon tile `bg-danger/10 text-danger`, replacing hardcoded `red-500`/`red-50`/`red-950` variants. `default` tone untouched.
- `field.blade.php`, `input.blade.php`, `message.blade.php`, `select.blade.php`, `welcome-panel.blade.php`: no markup changes — already token- and component-based.
