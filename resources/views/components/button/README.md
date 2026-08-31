# resources/views/components/button

Design-system button component (top-level alias `<x-button.button>`).

## Files

| File | Purpose |
|---|---|
| `button.blade.php` | Button with variant, loading and disabled states. Renders a real `<button>` by default, or an `<a>` when an `href` is passed. |

## Props / states

- `variant`: `primary` (default), `secondary`, `success`, `danger`, `ghost` — mapped to `ui-button--{variant}`.
- `loading`: adds `ui-button--loading` and `aria-busy="true"`.
- `disabled`: adds `ui-button--disabled` and `disabled="disabled"` (or `aria-disabled` for anchors).
- `href`: when set, renders an anchor instead of a button.
- `type`: defaults to `button` (use `submit` via `<x-button.button type="submit">`).

These class hooks are asserted by `tests/Feature/Web/Views/DesignSystemComponentsTest.php`.
