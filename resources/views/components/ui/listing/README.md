# resources/views/components/ui/listing

Blade components for data listing/table views with filtering and pagination.

## Files

| File | Purpose |
|---|---|
| `filter-field.blade.php` | Grid-aware field wrapper for filter inputs. Renders an eyebrow label and manages responsive column spanning via the `span` prop. |
| `filter-panel.blade.php` | Container panel for filter fields with Search/Clear buttons and a results-count span. Buttons use `__()` translation calls. |
| `pagination.blade.php` | Semantic pagination container. Content is injected via slot (either Blade-rendered or JS-driven). |
| `table-card.blade.php` | Responsive data table wrapper with a loading skeleton row, configurable column count, and `aria-live="polite"` for accessibility. |

## Notes for developers / AI

- All user-facing strings use `__()` translation calls.
- `table-card.blade.php` uses `$head` and `$slot` for thead and tbody content respectively.
- `filter-panel.blade.php` provides an `$afterActions` slot for additional right-aligned controls.

## Recent Refactorings

- No markup changes needed: all four components are already token- and component-based (design-token utilities, `x-ui.buttons.*`, `x-ui.text.eyebrow`). The `table-card` loading dot uses the brand `primary` token.
