# Actions -- Automated Feature Tests for Action Classes

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is part of "The Quality Assurance Lab."

## What is this folder?

Feature-level tests for **Action classes** -- the "Worker Bees" that each do one specific job. These tests verify the actions work correctly when invoked in a full application context (with database, real models, etc.).

## What Gets Tested

| Test | What It Verifies |
|------|------------------|
| `CreateTicketActionTest` | Creating a ticket works end-to-end (validation, saving, status assignment, auditing, notification triggers) |
| `CreateUserActionTest` | Creating a user works end-to-end (password hashing, profile assignment, auditing) |

## How to run these tests

```bash
# All feature action tests
php artisan test tests/Feature/Actions

# A single test
php artisan test tests/Feature/Actions --filter=CreateTicketActionTest
```
