# TODO

- [ ] Fix missing Blade components for `/ui/login`
  - [ ] Determine which components are referenced by `resources/views/auth.blade.php`
  - [ ] Ensure Laravel can resolve `<x-ui.auth.* />` component tags
  - [ ] Implement fix (likely move auth component views under `resources/views/components/...` or replace tags with `@include`)
  - [ ] Clear Blade view cache
  - [ ] Re-test `/ui/login` route

