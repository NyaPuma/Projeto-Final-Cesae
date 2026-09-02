# Debug -- Automated Debug/Development Helper Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

## What is this folder?

Tests related to **debugging and development helpers** -- tools that help developers diagnose issues (e.g., profiling, logging, information endpoints).

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/Debug

# A specific test
php artisan test tests/Feature/Debug --filter=TestName
```
