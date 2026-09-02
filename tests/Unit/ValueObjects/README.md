# Value Objects -- Automated Unit Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab." Unit tests check individual pieces of code in isolation.

## What is this folder?

Unit tests for **Value Objects** -- small immutable objects representing values (e.g., a ticket's status). These tests check each piece on its own (without the database or other parts of the system) to make sure it works correctly.

## What Gets Tested

Each test file in this folder verifies that its corresponding class behaves correctly:
- Valid inputs produce correct outputs
- Invalid inputs are handled gracefully (or rejected)
- Relationships, formatting, and business rules within the class are correct

## How to run these tests

```bash
# All unit tests in this folder
php artisan test tests/Unit/ValueObjects

# A single test
php artisan test tests/Unit/ValueObjects --filter=TestName
```
