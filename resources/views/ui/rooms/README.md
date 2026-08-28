# resources/views/ui/rooms

Room management views.

## Files

| File | Purpose |
|---|---|
| `create.blade.php` | Room creation form. |
| `edit.blade.php` | Room edit form. |
| `show.blade.php` | Room detail page with status bar, KPI indicators, room info, occupancy, equipment list, recent tickets and audit trail (layout mirrors `ui/equipments/show.blade.php`). |

## Notes for developers / AI

- `show.blade.php` is presentation-only. Status/priority/audit badge classes are no longer defined here — they live in the shared `x-ui.text.badge` component (`resources/views/components/ui/text/badge.blade.php`), and the KPI cards use the shared `x-ui.stats.stat-card` component. Do not reintroduce per-page palette maps.
- The occupancy bar width is dynamic, set via the CSS variable idiom: `style="--capacity: {{ $capacityPercent }}%"` + `.room-capacity-fill { width: var(--capacity, 0%); }` in `resources/css/pages/rooms.css` (imported by `resources/css/app.css`).
- Icons are inline Heroicons SVGs defined in the page's `@php` block (`$icon` array) — no emojis.
- Subtitle de-duplication: `$locationParts` applies `array_filter` + `array_unique`; the floor is only prefixed with "Piso" when the stored value starts with a digit (it may already include the prefix), avoiding "Piso Piso 0".

## Recent Refactorings

- `show.blade.php`:
  - Badge/status maps converted to state tokens (`emerald`→`success`, `amber`/`orange`→`warning`, `rose`→`danger`, `blue`→`info`, `slate`→neutral); `purple` retained for `crítica` priority (documented exception).
  - Active/inactive dots → `bg-success` / `bg-[var(--border)]`; warranty text → `text-danger` / `text-success`; notes → `border-warning/20 bg-warning/5`; KPI counts → `text-warning` / `text-info`.
  - Occupancy bar: inline `style="width: {{ $capacityPercent }}%"` → CSS var idiom (`--capacity`), gradient `to-amber-400` → `to-warning`.
  - Layout aligned with `ui/equipments/show.blade.php`: the "Ocupação" card was moved from the top of the right column into the left column (between "Informação da Sala" and "Equipamentos da Sala") and restyled to the section-card convention (`overflow-hidden` + `px-6 py-4` header); the right column now starts with "Tickets Recentes" + "Registo de Auditoria", exactly like the equipment detail page.
  - KPI cards enlarged (`p-4` → `p-5`, values `text-2xl` → `text-3xl`) so the room top isn't visually smaller than the equipment detail top.
  - Shared-component migration: badge maps moved to `x-ui.text.badge`; KPI cards moved to `x-ui.stats.stat-card` (which unified both pages at equipment's reference size `p-4`/`text-2xl`, reverting the `p-5`/`text-3xl` bump); all emojis replaced with inline Heroicons SVGs; audit badge labels unified to `common.*` keys; subtitle duplication fixed (`array_unique` + conditional "Piso" prefix).
- `create.blade.php` and `edit.blade.php` verified clean (UI Kit components + token/`--var` classes only).
