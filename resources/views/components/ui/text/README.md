# resources/views/components/ui/text

Low-level typography components for displaying styled text labels and badges.

## Files

| File | Purpose |
|---|---|
| `eyebrow.blade.php` | Dynamic eyebrow/label component. Renders uppercase semibold text with configurable tag (`as`), tone (primary/muted/default), size and letter-spacing. Used for section labels and subtitles. |
| `pill.blade.php` | Pill/badge component for statuses and labels. Renders an inline-flex rounded-full badge with configurable tone (primary/success/warning/danger/neutral) and size. |
| `badge.blade.php` | Shared status/priority/audit badge with the entity palette consolidated in a single source. Kinds: `equipmentStatus`, `ticketStatus`, `priority`, `audit`. Sizes: `sm` (table rows), `xs` (dense), `badge` (card headers), `md` (status bar). Audit labels default to `common.Criação`/`common.Alteração`/`common.Eliminação`. |

## Notes for developers / AI

- `eyebrow.blade.php` resolves the HTML tag dynamically via the `as` prop — it can render as `<span>`, `<h2>`, `<p>`, etc.
- `pill.blade.php` always renders as a `<span>`. Tones use a combination of Tailwind utility classes and CSS theme variables.
- `badge.blade.php` intentionally replaces the per-page badge maps that used to exist in `ui/equipments/show.blade.php` and `ui/rooms/show.blade.php` (they are now gone — never re-introduce them). Unknown values fall back to a neutral tone and render the raw value. A non-empty slot overrides the label.

## Recent Refactorings

- `pill.blade.php`: `success`/`warning`/`danger` tones migrated to state tokens (`border-/bg-/text-` of `success`/`warning`/`danger`) replacing hardcoded `emerald-500/600`, `amber-500/600`, and `red-500/600` + `dark:` variants — colors now auto-adapt in dark mode with WCAG AA-contrast light-mode values. `primary`/`neutral` tones unchanged.
- `badge.blade.php` (NEW): extracted the equipment-status / ticket-status / priority / audit tone maps that were duplicated in `ui/equipments/show.blade.php` and `ui/rooms/show.blade.php` into one component (single palette source). Size classes own their corner radius to avoid conflicting `rounded-*` utilities.
- `eyebrow.blade.php`: no markup changes needed — letter-spacing values are the component's parameterized design values (not page-level hardcodes) and tone/size map to theme tokens.
