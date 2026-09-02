# resources/views/preferences

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md)

User preference editing views.

## Files

| File | Purpose |
|---|---|
| `edit.blade.php` | Preferences form page. Lets users configure language, currency, date format, time format and number format. Each field triggers an AJAX update on change. Uses `__()` translation calls for all labels and descriptions. |

## Notes for developers / AI

- Extends `ui.layout` (Design Kit layout). Each `<select>` carries a `data-ajax-url` attribute pointing to a dedicated route for that preference field; the AJAX submit and success/error feedback are handled by an Alpine component (`x-data`) on the form card — no inline `<script>` blocks.
- The final "Guardar Todas as Preferências" submit posts to `preferences.update_all`.

## Recent Refactorings

- `edit.blade.php`: **Rebuilt from scratch.** Previously extended the non-existent `layouts.app` layout (the page was broken) and used Bootstrap/Tailwind base-palette classes plus a raw inline `<script>` with a `showNotification` helper. Now: extends `ui.layout`, uses `x-ui.partials.page-header`, `x-ui.form.card`, `x-ui.form.field` and design-token utilities; the inline script was replaced by an Alpine component that reads `data-ajax-url` and posts to the per-field routes (project convention, same as `activity-timeline-card`). All inline-callbacks strings routed through `__()` keys (`preferences.Preferências atualizadas com sucesso.`, `common.Por favor, tente novamente mais tarde.`). Success feedback shown with the `success` token.
- No other files in this folder.