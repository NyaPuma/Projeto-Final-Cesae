# resources/views/ui/definicoes

Settings/preferences views (Portuguese folder name — retained as a route convention).

## Files

| File | Purpose |
|---|---|
| `aparencia.blade.php` | Appearance/theme settings page. |
| `sistema.blade.php` | System settings page. |

## Notes for developers / AI

- Both files were already clean (no PT code-level comments).
- The folder name `definicoes` is Portuguese for "settings" — renaming it would require route and view reference updates across the codebase.

## Recent Refactorings

### 2026-08-27

- **aparencia.blade.php**: preset swatch inline styles converted to the CSS-variable data idiom — the blade now passes only the dynamic value (`style="--swatch: {{ $preset['primary'] }}"`), while the actual swatch styling lives in `resources/css/pages/definicoes.css` (`.theme-preset-card__swatches span { background: var(--swatch, var(--color-surface)); }`). Everything else was already component/token-based.
- **sistema.blade.php**: verified clean — uses the custom form classes from `resources/css/components/forms.css` (`.form-label`/`.form-control`/`.form-select`/`.form-help`, not Bootstrap), `ui-button` kit buttons and `data-auto-save`/`data-reset` Alpine/JS hooks. No inline styles, handlers or scripts.
