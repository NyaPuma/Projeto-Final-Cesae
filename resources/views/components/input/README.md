# resources/views/components/input

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Design-system input component (top-level alias `<x-input.input>`).

## Files

| File | Purpose |
|---|---|
| `input.blade.php` | Text field with label, hint and validation state. Renders `ui-input-field` (with `ui-input-field--error` when the field has a validation error), a `<label>`, a hint (`ui-input-field__hint`) and an error message (`ui-input-field__error`). Sets `aria-invalid="true|false"` based on the shared `$errors` bag. |

## Props

- `name` (required), `id`, `type` (default `text`), `label`, `placeholder`, `required`, `hint`, `value`.

These class hooks are asserted by `tests/Feature/Web/Views/DesignSystemComponentsTest.php`.
