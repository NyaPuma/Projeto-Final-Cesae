# resources/views/ui/stock/parts

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Part detail and CRUD views.

## Files

| File | Purpose |
|---|---|
| `create.blade.php` | Part creation form. |
| `edit.blade.php` | Part edit form. |
| `show.blade.php` | Part detail page with status bar, part info, suppliers, recent movements and related data. |

## Notes for developers / AI

- `show.blade.php` uses `$lowStock` flag to toggle status badge between "Stock baixo" and "Stock OK".

## Recent Refactorings

- Verified clean (UI Kit components + token/`--var` classes only; no inline `style=`/`onclick=`/`script`).
