# Views

Feature tests for Blade view rendering and front-end design system output.

| File | Purpose |
|------|---------|
| `AssetPipelineTest.php` | Vite asset pipeline integration in views |
| `DesignSystemComponentsTest.php` | Design-system component rendering |
| `DesignSystemViewsTest.php` | Design-system page layouts |
| `UiUsabilityTest.php` | Usability/accessibility markup assertions |

## Inline script policy (AssetPipelineTest)

Views must not contain inline CSS/JS. Three sanctioned exceptions exist:

1. **Synchronous anti-FOUC theme script** in layout `<head>` — must contain both `prefers-color-scheme` and `localStorage.getItem('theme')`.
2. **i18n bootstrap** — the `locale-config` partial exposing translations as `window.SGM_*`.
3. **Non-executing data** — `<script type="application/json">` blocks (e.g. `theme-meta`).

Every page key used via `@section('page_key', ...)` must be registered in `resources/js/bootstrap/page-registry.js`.

## Design-system components (DesignSystemComponentsTest)

Top-level aliases implemented under `resources/views/components/{button,card,input}/`:

| Alias | Expected class hooks |
|-------|----------------------|
| `<x-button.button>` | `ui-button`, `ui-button--primary\|secondary`, `--loading`, `--disabled`, `aria-busy`, `disabled` |
| `<x-card.card>` | `ui-card`, `ui-card--loading`, `ui-card-skeleton` |
| `<x-card.badge>` | `ui-card-badge--{variant}`, `--pill`, `--has-dot` |
| `<x-card.alert>` | `ui-card-alert--{variant}`, title + slot |
| `<x-input.input>` | `ui-input-field`, `--error`, label, hint, `aria-invalid`, error message |
