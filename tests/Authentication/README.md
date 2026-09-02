# Authentication -- Automated Authentication Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is part of "The Quality Assurance Lab" that tests the login, logout, and password-recovery workflows.

## What is this folder?

These tests verify the **entire authentication lifecycle** -- everything related to proving who a user is before they can access the system.

## What Gets Tested

| Test | What It Verifies |
|------|------------------|
| `AuthenticationTest` | Basic authentication works (login succeeds with correct credentials) |
| `LoginFlowTest` | The full login flow works (form → validation → credentials check → session created) |
| `AuthFlowTest` | The complete authentication workflow (login, access protected pages, logout) |
| `AuthEdgeCasesTest` | Edge cases: wrong password, locked accounts, expired sessions, missing fields |
| `PasswordResetFlowTest` | The "forgot password" flow (request reset → receive email → set new password) |

## Important Security Rules Being Tested

- **Account lockout**: After 5 failed login attempts, the account locks for 15 minutes
- **Password rules**: New passwords must meet strength requirements
- **Session security**: Sessions expire and are protected
- **Reset links**: Reset links expire after a timeout and can only be used once

## How to run these tests

```bash
# All authentication tests
php artisan test tests/Authentication

# A single test
php artisan test tests/Authentication --filter=PasswordResetFlowTest
```
