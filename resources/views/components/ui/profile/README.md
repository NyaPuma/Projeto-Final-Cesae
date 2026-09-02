# resources/views/components/ui/profile

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Profile page card components for user settings.

## Files

| File | Purpose |
|---|---|
| `delete-account-card.blade.php` | Danger-zone card for account deletion. Uses Alpine.js to show a confirmation modal. Delegates to `x-ui.form.card` with `tone="danger"`. |
| `information-card.blade.php` | Personal information form (name + email). Email field is read-only. Uses `data-*` attributes for JS-driven save/success/error messaging. |
| `security-card.blade.php` | Password-change form with strength meter and requirements checklist (length, case, symbol/number). Powered by `passwordStrength()` Alpine.js data. |
| `summary-card.blade.php` | Read-only profile summary card showing avatar initial, name, email, role pill, status, last update and member-since dates. |

## Notes for developers / AI

- All `__('...')` calls are translation keys — do not translate the PHP strings, only the key values in `lang/` files.
- `summary-card.blade.php` calls `LocalizationService` directly for date formatting.
- `delete-account-card.blade.php` directs users to contact an admin rather than providing self-service deletion.

## Recent Refactorings

- `security-card.blade.php`: Password-strength checklist active states `text-emerald-600 dark:text-emerald-400` → `text-success`; inactive states `text-zinc-500 dark:text-zinc-400` → `text-muted`; strength-meter inactive bars `bg-zinc-200 dark:bg-zinc-800` → `bg-[var(--border)]`; level label color → `text-muted`. Bar/label colors driven by JS (`password-strength.js`) were already token-based.
- `delete-account-card.blade.php`: Confirmation modal border `red-500/20` → `danger` token (`border-danger/20`).
- `information-card.blade.php`, `summary-card.blade.php`: no markup changes needed — already token- and component-based.
