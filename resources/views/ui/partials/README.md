# resources/views/ui/partials

Reusable partial components included by the main layout and other views.

## Files

| File | Purpose |
|---|---|
| `background-effects.blade.php` | Background glow/gradient visual effects. |
| `currency-dropdown.blade.php` | Currency selection dropdown for the topbar. |
| `currency-modal.blade.php` | Full currency selection modal with currency name display. |
| `date-format-dropdown.blade.php` | Date format selection dropdown for the topbar. |
| `date-format-modal.blade.php` | Full date format selection modal with preview examples. |
| `desktop-sidebar.blade.php` | Desktop sidebar with branding, nav links and auth box. |
| `language-dropdown.blade.php` | Language selection dropdown for the topbar. |
| `language-modal.blade.php` | Full language selection modal with continent grouping. |
| `locale-config.blade.php` | Locale configuration exposed to JavaScript (intl formatting). |
| `locale-modal.blade.php` | Full language/region selection modal with flags, search and formatting preview. |
| `locale-trigger.blade.php` | Locale trigger button for opening locale settings. |
| `localization-modal.blade.php` | Unified localization modal with tabs for language, currency, date, time and decimal format. |
| `mobile-nav.blade.php` | Mobile navigation drawer with overlay, branding, links and auth box. |
| `number-format-dropdown.blade.php` | Number format selection dropdown for the topbar. |
| `preferences-dropdowns-js.blade.php` | JavaScript for preference dropdowns (close on outside click, open/close logic, AJAX update). |
| `theme-meta.blade.php` | Theme meta tags providing light/dark mode and active theme ID to JavaScript. |
| `topbar.blade.php` | Top navigation bar. |
| `notifications-modal.blade.php` | Notifications modal with backdrop blur (same pattern as localization modal). |

## Notes for developers / AI

- `preferences-dropdowns-js.blade.php` is a legacy placeholder, no longer included.
- `language-dropdown.blade.php`, `currency-dropdown.blade.php`, `date-format-dropdown.blade.php` and `number-format-dropdown.blade.php` are legacy orphans — they are NOT included anywhere (the unified `localization-modal.blade.php` replaced them). Keep only if intentionally revived.
- `theme-meta.blade.php` loads the active theme preset via `ThemePresetService` and sets `<meta>` tags consumed by `early-theme.js` and `core/theme.js`. The inline `<script type="application/json" id="themePresetsData">` is a data-only bridge (no logic) consumed by `core/theme.js` and `pages/definicoes-aparencia.js` — documented exception.
- `locale-config.blade.php` generates a large inline JS configuration block with auth labels, locale metadata and translation strings.
- Topbar locale triggers use `data-action="open-locale-modal"` with `data-tab="language|currency|date|time|number"`; handled by `resources/js/components/localization-modal.js` (reads `btn.dataset.tab`). No inline `onclick="openLocalizationModal(...)"` handlers.

## Recent Refactorings

- `topbar.blade.php`: five inline `onclick="openLocalizationModal('…')"` handlers replaced with `data-action="open-locale-modal" data-tab="…"`.
- `localization-modal.js`: open-trigger binding now passes `btn.dataset.tab` to `openModal()` so the clicked button opens the matching preference tab.
- Verified clean: `background-effects`, `currency-modal`, `date-format-modal`, `desktop-sidebar`, `language-modal`, `locale-modal`, `locale-trigger`, `mobile-nav`, `notifications-modal`, `localization-modal` (all `data-*` attributes, no inline JS/CSS).
- `locale-config.blade.php`: `SGM_DASHBOARD_I18N` and `SGM_TICKETS_I18N` bridges consolidated here (see file).
