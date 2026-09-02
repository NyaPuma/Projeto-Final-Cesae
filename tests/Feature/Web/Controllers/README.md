# Controllers -- Web Controller Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Tests for the **web controllers** -- the request handlers that respond to browser page requests. Each test verifies a controller responds correctly to valid and invalid requests.

| Test | What It Verifies |
|------|------------------|
| `DashboardRedirectTest` | Correct dashboard redirection behavior |
| `PageControllerTest` | Page routes respond with the correct view |
| `PreferencesControllerTest` | Preference save/load works |
| `ProfileControllerTest` | Profile view/update works with validation |
| `RegisterControllerTest` | Registration validation and creation work |
| `RoomControllerTest` | Room CRUD via web routes works |
| `UiControllerTest` | UI routes return the correct page |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/Web/Controllers

# A single test
php artisan test tests/Feature/Web/Controllers --filter=TestName
```
