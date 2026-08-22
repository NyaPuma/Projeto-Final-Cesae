# app/Http/Requests

Form request classes for input validation and authorization in the SGM maintenance management platform.

## Purpose

Each request class encapsulates validation rules, authorization logic, and input sanitization for a specific API endpoint or controller action. This follows Laravel's Form Request pattern, keeping validation logic out of controllers.

## Structure

- **Store*Request** — Create operations (e.g., `StoreTicketRequest`, `StoreRoomRequest`)
- **Update*Request** — Update operations (e.g., `UpdateEquipmentRequest`, `UpdateProfileRequest`)
- **Schedule*Request** — Scheduling operations (e.g., `ScheduleMaintenanceRequest`)
- **Submit*Request** — Submission operations with complex validation (e.g., `SubmitBudgetRequest`)
- **Auth requests** — Login, registration, password reset (`LoginRequest`, `RegisterRequest`, `ResetPasswordRequest`)

## Key Patterns

- **`prepareForValidation()`** — Trims whitespace from text fields before validation
- **`rules()`** — Returns validation rules array using Laravel's validation DSL
- **`attributes()`** — Maps field names to human-readable labels for error messages (user-facing, i18n domain)
- **`after()`** — Custom post-validation logic (e.g., `SubmitBudgetRequest` validates budget totals)
- **`authorize()`** — Authorization check (most return `true`; admin-only requests check `isAdmin()`)

## Notes

- `attributes()` labels are user-facing strings — part of the i18n domain, not normalized in this refactor
- Validation messages using `__()` translation keys are also i18n domain
- Database enum values in rules (e.g., `'operacional'`, `'manutenção'`) are DB-level constraints — reported separately
