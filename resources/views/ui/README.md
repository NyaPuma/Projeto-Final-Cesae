# resources/views/ui

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Main Blade views for the application's UI (web interface).

## Files

| File | Purpose |
|---|---|
| `analytics.blade.php` | Analytics dashboard page. |
| `audits.blade.php` | Audit log listing page with filter panel and paginated table. |
| `auth-reset.blade.php` | Password reset page. |
| `auth.blade.php` | Login/registration page. |
| `equipments.blade.php` | Equipment listing page. |
| `index.blade.php` | Dashboard/home page. |
| `layout.blade.php` | Main app shell layout (sidebar, topbar, content area, background effects). |
| `profile.blade.php` | User profile page. |
| `rooms.blade.php` | Rooms listing page. |
| `ticket-create.blade.php` | Ticket creation form with priority cards, equipment autocomplete and image upload. |
| `ticket-detail.blade.php` | Ticket detail/view page. |
| `tickets.blade.php` | Tickets listing page. |
| `users-create.blade.php` | User creation form. |
| `users-edit.blade.php` | User edit form with avatar section. |
| `users.blade.php` | Users listing page with filter panel and paginated table. |

## Notes for developers / AI

- All views extend `ui.layout` via `@extends('ui.layout')`.
- User-facing strings use `__()` translation calls — do not modify, update `lang/` files instead.
- `layout.blade.php` defines the sidebar nav items, background effects, mobile nav, desktop sidebar, topbar and injected viewport.
- `ticket-create.blade.php` uses `data-priority` attributes with Portuguese DB values (`baixa`, `média`, `alta`, `crítica`) — these map to `TicketPriorityEnum` and should not be renamed without updating the enum.

## Recent Refactorings

### 2026-08-27 — ui/ root views: tokens, kit components, i18n consolidation

- **analytics.blade.php**: `#analyticsMessage` base element now carries token defaults (`border-[var(--border)]`, `text-muted`); JS `showMessage()` overrides the class list on render (error → `border-danger/20 bg-danger/5 text-danger`, success → `border-success/20 bg-success/5 text-success`). Chart/metric-card call sites already token-based; `Disponibilidade` keeps the documented `purple` exception.
- **index.blade.php**: removed the inline `<script>` + `@php $dashboardTranslations` block. The `window.SGM_DASHBOARD_I18N` bridge moved into the central `ui.partials.locale-config` partial. Picket/status colors tokenized: online dots `bg-emerald-500` → `bg-success`, "em curso" badges `text-amber-500 bg-amber-500/10` → `text-warning bg-warning/10` and `text-emerald-500 bg-emerald-500/10` → `text-success bg-success/10`, offline dot `bg-slate-500` → `bg-[var(--border)]`.
- **tickets.blade.php**: removed the inline `<script>` + `@php $ticketTranslations` block. Ticket list translations (`priority`/`status` maps, table headers, pagination) merged into `window.SGM_TICKETS_I18N` inside `ui.partials.locale-config` (`Object.assign(existing, uiTranslations, ticketsTranslations)`).
- **audits.blade.php**: replaced the hand-rolled back-link `<a>` with `x-ui.page-actions.back-button`; loading text now uses the `ui.A carregar histórico...` key.
- **auth / auth-reset**: already fully component/token-based (`x-ui.auth.shell`, `text-[var(--text)]`, `focus:ring-primary/15`, `text-[var(--on-primary)]`) — no changes.
- **equipments / rooms / profile / users / users-create**: already clean (kit components + tokens). `users-edit.blade.php`: `A carregar perfis...` now uses the `ui.A carregar perfis...` key.
- **ticket-create.blade.php**: priority cards tokenized — `emerald` → `success`, `amber` → `warning`, `red` → `danger` (borders/text/dots), matching the token vocabulary already used by `pages/ticket-create/priority.js` for selected states. `crítica` card keeps the documented `purple` exception.
- **ticket-detail.blade.php**: all state surfaces tokenized — budget/approval cards `amber-500` → `warning`, approved/completion `emerald-*` → `success`, rejected `rose-*` → `danger`. Solid action buttons (`bg-emerald-600`, `bg-rose-600`, `bg-amber-600`, `text-white`) converted to the established ghost-token pattern (`bg-<state>/10 text-<state> border border-<state>/30 hover:bg-<state>/20`). `ticketMessage`/`#priorityWarningModal` keep token defaults; JS `showMessage()` overrides classes on render.
- **layout.blade.php**: verified clean — uses the project's data-* config-attribute pattern (consumed by `core/auth-box.js`, `pages/analytics/charts.js`) and includes the `locale-config` partial; no inline styles/handlers.
- **locale-config.blade.php**: now the single source for ALL page i18n bridges including the former per-page `SGM_DASHBOARD_I18N` and the ticket-list `SGM_TICKETS_I18N` translations. The inline `<script>` data-bridge block is a deliberate, project-wide exception (JS modules read `window.SGM_*` config objects).
- No hardcoded fonts or Bootstrap classes remain in the ui/ root views.

## Notes for developers / AI (continued)

- The `window.SGM_*_I18N` data-bridge script blocks (locale-config, swagger) are the project's established mechanism for passing translations to JS modules (see `resources/js/utils/locale.js`). They carry data only, not logic, and are treated as a deliberate exception — do not remove them without migrating the JS modules to another configuration channel.
