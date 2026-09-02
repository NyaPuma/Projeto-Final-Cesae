# Seeders -- Automated Database Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab" that checks the database (the filing cabinet of data).

## What is this folder?

Tests for **Seeders** -- the tests that verify the 'seed data' (reference data like roles, statuses, categories) is valid and complete.

## What Gets Tested

The test files here verify the database behaves correctly and follows the rules the business expects.

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Database/Seeders

# A specific test
php artisan test tests/Database/Seeders --filter=TestName
```
