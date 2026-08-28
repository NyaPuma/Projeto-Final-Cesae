# resources/views/components/ui/buttons

Blade button components. These are thin wrappers that delegate to base button components with pre-configured defaults.

## Files

| File | Purpose |
|---|---|
| `button.blade.php` | General-purpose button wrapper. Forwards variant, size, weight and type props to the base button component. |
| `icon-button.blade.php` | Icon-only button with automatic shape (square/round) and size classes. Wraps the base button with weight=bold. |
| `submit.blade.php` | Submit button wrapper. Same as button.blade.php but pre-sets type to submit. |

## Notes for developers / AI

- All three components delegate to the base button component chain (`x-ui.page-actions.base-button` or `x-ui.buttons.button`).
- No user-facing strings in these files — labels are passed via slots.

## Recent Refactorings

- No markup changes needed: all three are thin wrappers delegating to `x-ui.page-actions.base-button` / `x-ui.buttons.button` (Design Kit button chain) with token-based sizing (`text-base`, `text-sm`).
