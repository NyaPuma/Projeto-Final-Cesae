# resources/views/components/ui/analytics

Blade components for the analytics dashboard. Each component is a self-contained, reusable UI building block used by analytics views.

## Files

| File | Purpose |
|---|---|
| `activity-timeline-card.blade.php` | Reactive activity timeline with AJAX loading via Alpine.js. Supports loading skeleton, error, and empty states. WCAG accessible (role="feed", aria-live). |
| `aside-card.blade.php` | Compact stat card for displaying a single metric/KPI with an optional label and value. Uses `x-ui.text.eyebrow`. |
| `aside-pill.blade.php` | Thin wrapper around `x-ui.text.pill` for consistent badge/label rendering in analytics layouts. |
| `chart-card.blade.php` | Structured card with a canvas element, header (eyebrow/title/description), and an `$aside` slot for action buttons. |
| `equipment-distribution-card.blade.php` | Specialized donut chart card with a central total indicator and a legend container. Default props map to ticket priority distribution. |
| `export-actions.blade.php` | Group of CSV/PDF/Excel export buttons using `x-ui.page-actions.export-link`. Includes `data-async-export` for client-side progress tracking. |
| `hero.blade.php` | Top hero section for the analytics dashboard. Displays a badge, title, description, and an operational status card with a live pulse indicator. |
| `list-card.blade.php` | Generic container card with a header and a body slot, designed for AJAX-loaded listings. |
| `metric-card.blade.php` | Statistical card showing an eyebrow label, a large value, an optional icon, and a description. Value is injected dynamically via JS. |
| `section-heading.blade.php` | Reusable section header with eyebrow, title, optional description, and an `$aside` slot for right-aligned actions. Responsive layout. |

## Notes for developers / AI

- All user-facing strings are passed via `__()` translation calls or component props — never hardcoded.
- Components use CSS custom properties (`var(--surface)`, `var(--border)`, etc.) for theming.
- `export-actions.blade.php` has hardcoded `data-processing-label` attributes (e.g., "A gerar CSV...") — these are user-facing and belong to the i18n domain.
- `equipment-distribution-card.blade.php` defaults are set for ticket priority charts but are fully overridable via props.
- `export-actions.blade.php` `data-processing-label` values ("A gerar CSV...") have no lang keys yet — flagged for future i18n.

## Recent Refactorings

- `activity-timeline-card.blade.php`: Default activity dot/icon fallbacks moved from `emerald-500` to the brand `primary` token (`bg-primary/10`, `bg-primary`) — neutral feed color that auto-adapts to dark mode; error state moved to `danger` (`bg-danger/10`, `bg-danger`, `text-danger`, replacing hardcoded `red-500/red-600 dark:red-400`). Dynamic per-item colors from the API remain untouched.
- `hero.blade.php`: Decorative glow `blue-500/5` → `info` token; description typography `text-[15px]` → `text-base` (design-token size); "Operacional/Online" pulse moved from `emerald-500` to `success`.
- `metric-card.blade.php`: Default `icon_bg_class` => `bg-primary/10` (was `bg-emerald-500/10`).
- `ui/analytics.blade.php` callers: MTTR metric icon/background → `success`; Espera → `info`; SLA → `warning`; Disponibilidade intentionally retains `purple` (no state token — data-viz distinction, same policy as the `crítica` priority exception).
- `chart-card`, `equipment-distribution-card`, `aside-card`, `aside-pill`, `list-card`, `section-heading`, `export-actions`: no markup changes — already token/component-based.
