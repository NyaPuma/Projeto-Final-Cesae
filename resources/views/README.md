# resources/views

Top-level Blade views that extend layout templates and compose UI components.

## Files

| File | Purpose |
|---|---|
| `calendar.blade.php` | Full-page calendar view for operational scheduling. Extends `ui.layout`. Contains an operational summary panel, a FullCalendar instance container, an event details modal, and a preventive maintenance scheduling modal. All user-facing labels use `__()` translation calls. |
| `main.blade.php` | Public landing/welcome page. Extends `layouts.layout`. Displays a hero section with a welcome pill, a headline, a login CTA link, and an SSL security info card. All user-facing labels use `__()` translation calls. |

## Notes for developers / AI

- `calendar.blade.php` depends on the `x-ui.partials.page-header` Blade component and the `calendar` JavaScript page module (`resources/js/pages/calendar.js`).
- `main.blade.php` depends on the `x-ui.text.pill` Blade component and the `layouts.layout` parent view.
- All visible strings are routed through Laravel's `__()` helper for i18n — they must not be hardcoded in English.

## Recent Refactorings

- `main.blade.php`: SSL security badge moved from `emerald-500` to the `success` design token (`bg-success/10 text-success`) — auto-adapts in dark mode.
- `calendar.blade.php`: Primary buttons use the `--on-primary` token for forelegibility (`text-(--on-primary)` — auto-switches white/black under contrast presets); form feedback uses `danger` token (`bg-danger/10 text-danger`); fixed malformed literal `</h3>` closing tags for the two summary/modal `<h2>` headings; hardcoded "Detalhes do Evento" header routed through `__('common.Detalhes do Evento')`.
