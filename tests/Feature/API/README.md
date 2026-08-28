# API

API endpoint feature tests covering controller behaviour and route/documentation wiring.

## Controllers/

| File | Purpose |
|------|---------|
| `AdminCrudFeatureTest.php` | Generic admin CRUD operations across resources |
| `AdminManagementTest.php` | Admin account management endpoints |
| `AdminUserControllerTest.php` | Admin-facing user management endpoints |
| `AiTriagingFeatureTest.php` | AI-assisted ticket triaging endpoint |
| `AnalyticsFeatureTest.php` | Analytics reporting endpoints |
| `ApiAuthTest.php` | API authentication (token/session) endpoints |
| `AttachmentOperationFeatureTest.php` | Ticket attachment upload/delete operations |
| `AuditEndpointsTest.php` | Audit log retrieval endpoints |
| `AuditFeatureTest.php` | Audit trail behaviour via the API |
| `BudgetFeatureTest.php` | Budget submission/approval workflow endpoints |
| `CalendarFeatureTest.php` | Calendar/event endpoints |
| `CommentOperationFeatureTest.php` | Comment create/update/delete endpoints |
| `EquipmentAndRoomCrudFeatureTest.php` | Equipment and room CRUD endpoints |
| `ErrorScenarioFeatureTest.php` | Error responses and validation failure scenarios |
| `NotificationFeatureTest.php` | Notification list/read endpoints |
| `NotificationFlowTest.php` | End-to-end notification delivery flows |
| `StockManagementFeatureTest.php` | Stock management endpoints |
| `TicketAssignmentFeatureTest.php` | Technician assignment endpoints |
| `TicketAuditLogTest.php` | Per-ticket audit log endpoints |
| `TicketAuthorizationFeatureTest.php` | Authorization rules on ticket endpoints |
| `TicketOperationsTest.php` | Core ticket CRUD/status operations |
| `TicketPhotoUploadTest.php` | Ticket photo upload endpoint |
| `TicketScheduleFeatureTest.php` | Ticket scheduling endpoints |
| `TicketSearchTest.php` | Ticket search/filtering endpoints |

## Routing/

| File | Purpose |
|------|---------|
| `SwaggerDocumentationTest.php` | Validates Swagger/OpenAPI documentation routes and spec |
