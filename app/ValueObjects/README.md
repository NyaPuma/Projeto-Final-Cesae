# app/ValueObjects

Immutable value objects that encapsulate validated, self-contained domain concepts.

## Files

| File | Purpose |
|---|---|
| `Email.php` | Validates and normalizes an email address. Provides `domain()`, `localPart()`, and `equals()` helpers. |
| `Money.php` | Represents a monetary amount (in cents) with a currency code. Supports arithmetic (`add`, `subtract`, `multiply`), comparison, and formatting. Enforces currency compatibility on operations. |
| `SerialNumber.php` | Validates and normalizes a serial number string (uppercase, 3+ alphanumeric/hyphen characters). |

## Notes for developers / AI

- All classes are `final readonly` — they are fully immutable by design.
- Constructing with invalid data throws `InvalidArgumentException`; no silent failures.
- `Money` stores amounts as integer cents to avoid floating-point precision issues — use `fromFloat()` to convert from decimal input.
- Referenced by: `StorePartData`, `UpdatePartData` (DTOs), `Equipment` and `Part` models, and their respective services/controllers.
- Tests in `tests/Unit/ValueObjects/` cover each value object thoroughly.
