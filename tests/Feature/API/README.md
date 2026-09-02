# API -- Automated API Endpoint Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is part of "The Quality Assurance Lab." These tests verify every API endpoint (the "doors" other software uses to talk to the system).

## What is this folder?

These are **feature tests for the API** -- they simulate real HTTP requests to every endpoint and verify the correct response comes back. This is how we know the system's "doors" work correctly.

## What Gets Tested (~30 test files)

| Test Area | What It Verifies |
|-----------|------------------|
| `ApiAuthTest` | Login/register/logout via API |
| `Ticket*Test` | Creating, updating, closing, searching, scheduling tickets |
| `TicketWorkflowFeatureTest` | Full ticket lifecycle via API |
| `TicketAssignmentFeatureTest` | Assigning technicians via API |
| `TicketAuthorizationFeatureTest` | Permission rules for ticket operations |
| `TicketPhotoUploadTest` | Uploading photo evidence |
| `BudgetFeatureTest` | Budget request/approval workflow |
| `StockManagementFeatureTest` | Inventory operations |
| `EquipmentAndRoomCrudFeatureTest` | Equipment and room CRUD |
| `AdminCrudFeatureTest` / `AdminManagementTest` | Admin panel operations |
| `AuditEndpointsTest` / `AuditFeatureTest` | Audit log access |
| `NotificationFeatureTest` / `NotificationFlowTest` | Notification delivery |
| `AnalyticsFeatureTest` | Dashboard/report data |
| `CalendarFeatureTest` | Calendar events |
| `QrCodeFeatureTest` | QR code generation |
| `AiTriagingFeatureTest` | AI recommendation |
| `ThemeFeatureTest` | Theme customization |
| `SystemSettingsFeatureTest` | System settings |
| `ActivityFeedFeatureTest` | Activity feed |
| `ErrorScenarioFeatureTest` | Error handling (404, 403, validation errors) |
| `PublicTicketFeatureTest` | Guest ticket submission (QR code flow) |
| `StockReportDownloadFeatureTest` | Report downloads |

## How to run these tests

```bash
# All API controller tests
php artisan test tests/Feature/API/Controllers

# A single test
php artisan test tests/Feature/API/Controllers --filter=TicketWorkflowFeatureTest
```
