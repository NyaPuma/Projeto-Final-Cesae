# resources/views/layouts

Base HTML layout used by all Blade views.

## Files

| File | Purpose |
|---|---|
| `layout.blade.php` | Main HTML document layout. Defines the `<head>` (meta tags, fonts, Vite assets, theme CSS), a skip-to-content a11y link, the `<main>` content area, and locale/theme partials. All user-facing strings use `__()` translation calls. |

## Notes for developers / AI

- The layout loads both `resources/css/app.css` and `resources/js/app.js` via `@vite`.
- Theme custom CSS is loaded from `route('theme.custom')` with a cache-buster query param.
- The `body` tag carries `data-*` attributes for auth URLs and labels, consumed by JS.
- RTL support is handled via `LocaleService::isRtl()` which adds the `rtl` class to `<html>` and `<body>`.

## Recent Refactorings

- No markup changes needed — already token-based (design-token utilities, `--on-primary` skip link, `data-*` attribute bridge to JS).
