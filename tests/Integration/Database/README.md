# Database integration -- Automated Integration Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab." Integration tests check how different parts of the system work together.

## What is this folder?

Integration tests for **Database integration** -- how the app integrates correctly with the database. These verify that the component works correctly when connected to its real surroundings (the database, mail system, etc.).

## What Gets Tested

Each test verifies the component integrates correctly and produces the expected result when real data flows through it.

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Integration/Database

# A specific test
php artisan test tests/Integration/Database --filter=TestName
```
