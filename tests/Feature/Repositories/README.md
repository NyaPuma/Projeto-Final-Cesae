# Repositories -- Automated Repository Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Tests for the **repository layer** -- the code that talks directly to the database and stores/retrieves data.

| Test | What It Verifies |
|------|------------------|
| `TicketRepositoryTest` | Ticket create/read/update/delete and filtering works |
| `UserRepositoryTest` | User storage and retrieval works |
| `EquipmentRepositoryTest` | Equipment storage and retrieval works |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/Repositories

# A single test
php artisan test tests/Feature/Repositories --filter=TestName
```
