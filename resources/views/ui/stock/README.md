# resources/views/ui/stock

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Stock management views.

## Files

| File | Purpose |
|---|---|
| `categories.blade.php` | Part categories management with create/edit form and categories table. |
| `dashboard.blade.php` | Stock dashboard with summary metrics, low-stock alerts, top consumed parts and stockout forecast. |
| `movements.blade.php` | Stock movements page with quick registration form and movements listing. |
| `parts.blade.php` | Parts listing page. |
| `plans.blade.php` | Maintenance plans management with create/edit form. |
| `suppliers.blade.php` | Suppliers listing page. |
| `tax-rates.blade.php` | Tax rates management with create/edit form and rates table. |

## Notes for developers / AI

- `dashboard.blade.php` loads data asynchronously via JS — the blade template contains loading placeholders.
- `tax-rates.blade.php` uses `str_replace('IVA', $taxLabel, ...)` to dynamically replace "IVA" with the locale-specific indirect tax label.

## Recent Refactorings

- All 7 views verified clean: UI Kit components, token/`--var` classes and `data-*` attributes only — no inline `style=`, `onclick=` or `script` blocks.
