# Token Plan and Design Decisions

## Color Palette

- `--color-primary`: #ea580c — industrial orange (visibility/safety signage). Hover: #c2410c; light (dark): #f97316.
- `--color-secondary`: #14213d — deep steel for navigation and dense surfaces.
- `--color-surface`: #ffffff — main surface (cards and panels).
- `--color-surface-2`: #f8fafc — page background and subtle panel alternation.
- `--color-border`: #cbd5e1 — neutral line to separate without competing.
- `--color-text`: #0f172a — dark primary text with good readability.
- `--color-text-soft`: #475569 — secondary text for less prominent contexts.

Ticket states (customizable in Settings → Appearance):
- `--color-ticket-open`: #2563eb — operational blue for open tickets.
- `--color-ticket-in-progress`: #f59e0b — active amber for in-progress tickets.
- `--color-ticket-resolved`: #10b981 — technical green for resolved.
- `--color-ticket-urgent`: #dc2626 — warning red for urgent.

Semantics: `--color-success: #16a34a; --color-warning: #d97706; --color-danger: #b91c1c; --color-info: #2563eb` (with light variants for dark mode).

**Justification:** the choice maintains the team identity (orange) instead of falling into the "default terracotta" of AI design — orange is read as a safety/fault color, consistent with the industrial context, and is not accompanied by a cream background or serifs. Dark mode uses the same hue with adjusted luminance.

## Typography

- `--font-sans`: Inter (loaded via fonts.bunny.net) / system-ui — modern, neutral body font for technical environments.
- `--font-mono`: JetBrains Mono / Cascadia Code / monospace — ticket IDs, tables, and tabular data (`.font-mono`, `font-feature-settings: "tnum"`).
- Fluid typographic scale with `clamp()`, minimums never below ~0.8rem (WCAG readability). Headings with `text-wrap: balance`.

## Layout

Industrial panel with persistent sidebar navigation, sticky state top bar (with blur), and content areas in cards. Moderate density: sufficient spacing for readability, but compact for operational viewing. Responsive from 360px — sidebar becomes a drawer below 1024px.

## Signature Element

The orange accent glow (`color-mix` over `--color-primary`) applied to highlight cards and section borders — conveys "industrial control panel" without a saturated interface or generic SaaS look. Ticket status badges use the status color as text over a tinted background of the same color.

## Theme Customization

Appearance settings page (admin-only, `role:admin`):
- `theme_settings` table (key/value); route `GET /theme/custom.css` generates CSS dynamically with ETag and cache (`stale-while-revalidate`).
- The layout loads `/theme/custom.css` **after** `app.css`, overriding only the `--color-*` tokens.
- `--on-primary` (readable text over primary) is calculated by luminance on the server — never hardcoded.
- Real-time preview via `resources/js/pages/definicoes-aparencia.js` (CSS property manipulation via external JS; zero inline styles).
- **Auto-save:** there is no "Save" button — clicking a preset persists immediately via AJAX (`POST ui.definicoes.aparencia.update`, which returns JSON when the request expects it); color edits save after debounce. The endpoint maintains contrast correction on the server, so the saved theme never diverges from what's on screen (no hybrid themes). An "Saving…/Saved" indicator shows the state.
- Predefined themes (WCAG AA verified) fill the advanced fields; each color is also **automatically corrected** (on client and server) to meet text/soft ≥4.5:1 over surface, primary button text ≥4.5:1, and primary vs surface ≥3:1. Never blocks saving — adjusts missing values (button text uses pure black/white, which guarantees ≥4.5:1 against any color).

**Paired light/dark presets (14 families × 2 = 28 themes):** `app/Services/ThemePresetService.php` is the single source of the 28 themes (orange, blue, green, wine, purple, teal, gold, graphite, pink, lemon, indigo, cyan, fuchsia, brown). Each family shares the hue and has a `light-*`/`dark-*` pair. The panel mode toggle (`data-action="toggle-theme"` → `resources/js/core/theme.js`) switches to the **equivalent of the same family** and, on admin accounts, persists it via `POST /theme/switch` (`ThemeController::switchTheme` saves colors + `theme_name`). On non-admin accounts the toggle is local (CSS + `localStorage`).

**Server is the source of truth:** the layout emits `theme-mode`, `active-theme`, and `user-role` meta tags (`ui/partials/theme-meta.blade.php`) that `early-theme.js` uses to apply the mode without flash. For admins, an old `localStorage.theme` that contradicts the server is cleared — prevents light themes from "misconfiguring" when toggling.

**Base colors always come from the preset (`/theme/custom.css`):** the `.dark` block in `tokens.css` no longer redefines primary/surface/text/borders/tickets — those tokens are exclusive to the active preset. The `.dark` block is limited to chrome and static derivatives (surface-2/3, muted, shadows, `color-scheme`). Thus, a dark preset maintains the family color (e.g., night blue with blue primary, not orange).

## CSS Architecture

- `resources/css/tokens.css` — **single source** for all values (colors, typography, spacing, radii, shadows, transitions, metrics) + `@theme inline` block that bridges to Tailwind v4, so utilities (`bg-primary`, `rounded-xl`, `shadow-md`…) resolve to tokens at runtime (follow dark mode and custom theme).
- `resources/css/theme/variables.css` — semantic alias layer (`--primary`, `--surface`, `--text`…) that references tokens; never defines primary values.
- Semantic components: `forms.css`, `badges.css`, `navigation.css`, `sidebar.css`, `buttons/`, `cards/`, `layout.css`.
- Derived tints use `color-mix(in srgb, var(--color-primary) X%, transparent)` to follow the custom theme (never hardcoded hex values in components).
- Legacy duplicate files were merged into `tokens.css`/`base.css` (old `theme/spacing.css`, `theme/radius.css`, `theme/typography.css`, `theme/shadows.css`, `theme/semantic.css`, `base/variables.css`).

## Accessibility (WCAG 2.1 AA)

- Global `:focus-visible` (2px outline `--primary`); never `outline: none` without a replacement.
- Skip-link to content in all layouts.
- Labels linked to inputs; errors with `role="alert"` and `aria-describedby`.
- `prefers-reduced-motion` respected (transitions/scroll disabled).
- Contrast validation in theme customization (server + client).

## System Settings

System settings page (admin-only, `role:admin`, `/ui/definicoes/sistema`):
- In the admin menu, "Theme" (`/ui/definicoes/aparencia`) is the appearance page and "Settings" (`/ui/definicoes/sistema`) is the system settings page.
- Exposes a **curated** list of options (`app/Services/SystemSettingsService.php`), each mapped to a real `config()` key with dots (e.g., `<input name="services.custom.ai.model">`). Secrets, credentials, and infrastructure drivers are **not** exposed — `openai.php`/`mail.php` remain only as config, consumed indirectly by the options (`services.custom.ai.*`, `services.custom.notification.mailer`).
- Persistence in `system_settings` (key/value, migration `2026_08_05_000002`); `SystemSettingsService::applyOverrides()` is called on `AppServiceProvider` boot and overrides the `config()` repository with database values before consumers read them (includes `date_default_timezone_set` for `app.timezone`). Only applies known keys from groups; watchdog if the table doesn't exist.
- **Saving:** selects, numbers, and toggles save automatically on `change` (via `resources/js/pages/definicoes-sistema.js`, debounce 300ms); groups with text fields show a "Save" button that submits the entire group; each group also has "Reset" to delete overrides and revert to `config/*.php` file values.
- AJAX JSON flow (`POST ui.definicoes.sistema.update`) accepts `{updates: {key: value}}` or `{reset: groupId}`, returning the effective normalized values to the screen.

## Maintenance Calendar (SGM)

The operational calendar (`/calendar` or `/ui/calendar`) manages scheduled preventive maintenance, past maintenance, and technical interventions using FullCalendar with SGM design tokens and `x-ui` aesthetics.

### Visual Differentiation
- **Preventive Maintenance (Scheduled / Future):** Primary brand accent (`--color-primary`), subtle tinted background (`color-mix(in srgb, var(--color-primary) 12%, var(--surface))`), solid 3.5px left border, clock icon, and time badge.
- **Past Maintenance (Completed / History):** Semantic success/neutral accent (`--color-success` / `--color-surface-3`), checkmark icon, and muted typography to avoid visual conflict with upcoming tasks.
- **Technical Intervention (Open tickets):** Semantic info accent (`--color-info` / `--color-ticket-open`), tool icon.

### Overlap & Concurrency Strategy
- **Month View (`dayGridMonth`):** Events are limited with `dayMaxEvents: 3`. When multiple events occur on the same day, an interactive `+N mais` pill button opens a rich, scrollable popover dialog (`fc-popover`) containing the full chronological list with status badges, equipment names, and times. No events are hidden or buried.
- **Week & Day Views (`timeGridWeek`, `timeGridDay`):** Concurrent events in the same time slot use `slotEventOverlap: true` rendered side-by-side in parallel columns with gutters and hover elevation (`z-index: 20`), ensuring full visibility and clickability.
- **Responsiveness:** Toolbar collapses into accessible touch targets on mobile (< 768px), popover centers as a modal sheet, and all interactive elements maintain a min 44px tap target.

