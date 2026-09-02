# Controllers -- API Controller Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Tests for the **API controllers** -- the request handlers that respond to programmatic API requests (JSON). Each test verifies the API responds with the correct status code and JSON structure.

| Test | What It Verifies |
|------|------------------|
| `ApiAuthTest` | API authentication (login, register, logout, me) |
| `Ticket*Test` | Ticket CRUD and workflow via API |
| `BudgetFeatureTest` | Budget request/approval lifecycle |
| `StockManagementFeatureTest` | Inventory operations |
| `EquipmentAndRoomCrudFeatureTest` | Equipment and room CRUD |
| `AdminCrudFeatureTest` | Admin panel operations |
| `AuditEndpointsTest` | Audit log endpoints |
| `NotificationFeatureTest` | Notification endpoints |
| `AnalyticsFeatureTest` | Analytics/report endpoints |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/API/Controllers

# A single test
php artisan test tests/Feature/API/Controllers --filter=TestName
```
