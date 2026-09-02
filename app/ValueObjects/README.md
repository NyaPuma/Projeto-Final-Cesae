# app/ValueObjects

Immutable value objects that encapsulate validated, self-contained domain concepts.

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "Precision Measuring Tools" -- special values that carry built-in validation (email, money, serial number).

## Overview

Value Objects (VOs) wrap a single, well-validated domain value. Unlike DTOs (which group a request's *payload* into a validated container), VOs encapsulate *long-lived domain concepts* — an email address, a monetary amount, a serial number — that carry their own invariants and can be reused across models, actions, and services.

All VOs:
- Are declared `final readonly` — fully immutable by design.
- Throw `InvalidArgumentException` in the constructor when given invalid input (no silent failures).
- Expose a `value()` getter and `__toString()`/`equals()` helpers.
- Have thorough unit tests in `tests/Unit/ValueObjects/`.

---

## Files

### `SerialNumber.php`

**File:** [`app/ValueObjects/SerialNumber.php`](SerialNumber.php)

**What value it wraps:** A normalized serial number string (e.g., `"SN-123456"`).

**Validation / constraints (in constructor `validate()`):**
- Must not be empty.
- Must be at least 3 characters long.
- Must match the pattern `^[A-Z0-9\-]+$` (uppercase letters, digits, hyphens only).

**Normalization:**
- Stores the value as `strtoupper(trim($serial))` — leading/trailing whitespace removed, letters uppercased.

**Methods:**
| Method | Description |
|--------|-------------|
| `__construct(string $serial)` | Validates and normalizes; throws `InvalidArgumentException` on invalid input |
| `value(): string` | Returns the normalized serial string |
| `equals(SerialNumber $other): bool` | Exact-value comparison with another SerialNumber |
| `__toString(): string` | Stringifies to the normalized value |

**Where it's used:**
- Conceptually aligns with the equipment/part `serial` / `sku` fields. The `Equipment` and `Part` models plus the `StoreEquipmentData` / `StorePartData` DTOs produce uppercase trimmed serial/SKU strings that match the VO's normalized form. (The VO class itself is currently referenced directly primarily by its unit tests; its invariants are enforced inline by the DTO sanitizers.)

---

### `Money.php`

**File:** [`app/ValueObjects/Money.php`](Money.php)

**What value it wraps:** A monetary amount, stored internally as **integer cents**, together with a three-letter ISO currency code (default `EUR`).

**Validation / constraints:**
- Amount must be non-negative (throws `InvalidArgumentException`).
- Currency must be exactly 3 characters (three-letter ISO code such as `EUR`, `USD`).
- Arithmetic operations (`add`, `subtract`) throw when the two operands use different currencies.

**Normalization:**
- Amount stored as `int` cents — avoids floating-point precision issues.
- Currency stored uppercased via `strtoupper()`.

**Static factories:**
| Factory | Description |
|---------|-------------|
| `fromFloat(float $amount, string $currency = 'EUR'): self` | Converts a decimal float into cents by `round($amount * 100)` |
| `zero(string $currency = 'EUR'): self` | A zero-value Money in the given currency |

**Instance methods:**
| Method | Description |
|--------|-------------|
| `amount(): int` | Amount in cents |
| `currency(): string` | ISO currency code |
| `toFloat(): float` | Amount as a decimal float (`amount / 100`) |
| `formatted(): string` | `number_format(toFloat(), 2) . ' ' . currency` (e.g., `"123.45 EUR"`) |
| `add(Money $other): self` | New Money = sum (same currency required) |
| `subtract(Money $other): self` | New Money = difference (same currency required) |
| `multiply(float $factor): self` | New Money = amount × factor (rounded to cents) |
| `equals(Money $other): bool` | Same amount **and** same currency |
| `isZero(): bool` | Amount === 0 |
| `isPositive(): bool` | Amount > 0 |
| `__toString(): string` | Returns `formatted()` |

**Where it's used:**
- Intended for monetary computations in stock/parts (cost price, sale price, stock value) and budget/repair cost flows. Its decimal-free design is aligned with how `StorePartData` / `UpdatePartData` carry `costPrice`/`salePrice` and how `CloseTicketData` and `BudgetSubmissionData` parse monetary amounts with 2-decimal precision.

---

### `Email.php`

**File:** [`app/ValueObjects/Email.php`](Email.php)

**What value it wraps:** A validated, normalized e-mail address.

**Validation / constraints (in `validate()`):**
- Must pass PHP's `filter_var($email, FILTER_VALIDATE_EMAIL)`; otherwise throws `InvalidArgumentException`.

**Normalization:**
- Stores the value as `strtolower(trim($email))` — leading/trailing whitespace removed, whole address lowercased.

**Methods:**
| Method | Description |
|--------|-------------|
| `__construct(string $email)` | Validates and normalizes; throws on invalid format |
| `value(): string` | Returns the normalized email |
| `domain(): string` | The part after `@` (e.g., for `user@example.com` → `example.com`) |
| `localPart(): string` | The part before `@` (e.g., for `user@example.com` → `user`) |
| `equals(Email $other): bool` | Exact comparison with another Email |
| `__toString(): string` | Stringifies to the normalized value |

**Where it's used:**
- Aligns with the email normalization performed across the app — `StoreUserData` and `UpdateUserData` DTOs lowercase emails via `mb_strtolower()`; `LoginRequest`, `RegisterRequest`, `StoreUserRequest`, `SendResetLinkRequest`, `ResetPasswordRequest` all lowercase+trim emails in `prepareForValidation()`. The `User` model's email field and the `userRepository->getAll()` / `UserService` flows carry these normalized addresses.

---

## Notes for developers / AI

- All classes are `final readonly` — they are fully immutable by design.
- Constructing with invalid data throws `InvalidArgumentException`; no silent failures.
- `Money` stores amounts as integer cents to avoid floating-point precision issues — use `fromFloat()` to convert from decimal input.
- Referenced by: `StorePartData`, `UpdatePartData` (DTOs), `Equipment` and `Part` models, and their respective services/controllers.
- Tests in `tests/Unit/ValueObjects/` cover each value object thoroughly.
