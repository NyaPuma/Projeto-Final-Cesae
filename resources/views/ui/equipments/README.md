# resources/views/ui/equipments

Equipment management views.

## Files

| File | Purpose |
|---|---|
| `create.blade.php` | Equipment creation form. |
| `edit.blade.php` | Equipment edit form. |
| `qr.blade.php` | Equipment QR code detail page with equipment info and actions. |
| `show.blade.php` | Equipment detail page with status bar, KPI indicators, info, associated room, recent tickets and audit trail. |

## Notes for developers / AI

- `show.blade.php` is presentation-only. Status/priority/audit badge classes live in the shared `x-ui.text.badge` component and KPI cards use the shared `x-ui.stats.stat-card` component — no per-page palette maps.
- Audit labels (`Criação` / `Alteração` / `Eliminação`) come from `common.php` i18n keys (defaults of `x-ui.text.badge` kind `audit`).
- Icons are inline Heroicons SVGs defined in the page's `@php` block (`$icon` array) — no emojis.
- The associated-room floor label only receives the "Piso" prefix when the stored value starts with a digit, avoiding "Piso Piso 0".

## Recent Refactorings

- `qr.blade.php`:
  - Inline `onclick="window.print()"` replaced with `data-action="print"`, handled by `initPrintActions()` in `resources/js/pages/analytics/export.js` (registered globally in `resources/js/bootstrap/page-registry.js`).
  - `[data-async-message]` div given token defaults (`border-[var(--border)] text-muted`).
- `show.blade.php`:
  - Badge/status maps converted from bare palette classes to state tokens (`emerald`→`success`, `amber`/`orange`→`warning`, `rose`→`danger`, `blue`→`info`, `slate`→neutral `border-[var(--border)]`/`text-muted`); `purple` retained for `crítica` priority (documented exception — no token).
  - Active/inactive dots: `bg-emerald-500` / `bg-slate-500` → `bg-success` / `bg-[var(--border)]`.
  - Warranty chips and expiry text: `text-rose-600 dark:` / `text-emerald-700 dark:` → `text-danger` / `text-success`; notes banner → `border-warning/20 bg-warning/5`.
  - Audit labels now use i18n keys; audit date fixed to `{{ app(LocalizationService::class)->formatDateTime(...) }}`.
  - Fixed stripped Blade expressions that rendered literally: `($equipment->warranty_until)` → `{{ formatDate }}`, `($audit->created_at)` → `{{ formatDateTime }}`.
  - Shared-component migration: badge maps moved to `x-ui.text.badge`; KPI cards moved to `x-ui.stats.stat-card`; all emojis (status bar, KPI, warranty, empty states) replaced with inline Heroicons SVGs; action buttons (`Código QR`, `Editar Equipamento`) now carry QR/pencil icons instead of the default plus; subtitle "Piso Piso 0" fixed.
- `create.blade.php` and `edit.blade.php` verified clean (UI Kit components + token/`--var` classes only).
