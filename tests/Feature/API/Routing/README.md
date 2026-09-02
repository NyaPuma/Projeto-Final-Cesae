# Routing -- API Routing Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Tests for the **API route definitions** -- the map of API URLs to handlers. These verify routes resolve to the correct controller actions.

| Test | What It Verifies |
|------|------------------|
| `ApiRouteConventionTest` | Routes follow the naming/URL conventions consistently |
| Routing tests | Every declared route reaches the correct handler |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/API/Routing

# A single test
php artisan test tests/Feature/API/Routing --filter=TestName
```
