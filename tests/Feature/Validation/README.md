# Validation -- Automated Validation Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Tests for **form/input validation** -- the rules that reject bad or malicious input.

| Test | What It Verifies |
|------|------------------|
| `.*ValidationTest` | Valid input is accepted; invalid input is rejected with clear error messages |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/Validation

# A single test
php artisan test tests/Feature/Validation --filter=TestName
```
