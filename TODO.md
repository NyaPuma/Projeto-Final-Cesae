# TODO - Bug Fixes & Test Suite Implementation

## Phase 1: Fix Critical Bugs in TicketController

### Bugs Found:
- [x] **Bug 1**: `routes/api.php` missing ticket routes (frontend calls `/api/tickets`)
- [x] **Bug 2**: `TicketController::search()` method missing (route `/tickets/search`)
- [x] **Bug 3**: `TicketController::startTicket()` method missing (route `PUT /technician/tickets/{id}/start`)
- [x] **Bug 4**: `TicketController::requestBudget()` method missing (route `PUT /technician/tickets/{id}/request-budget`)
- [x] **Bug 5**: `TicketController::scheduleTicket()` method missing (route `POST /tickets/{id}/schedule`)
- [x] **Bug 6**: `TicketController::openTickets()` method missing (route `GET /technician/tickets/open`)
- [x] **Bug 7**: `TicketController::closeTicket()` has wrong logic (should close, not assign)
- [x] **Bug 8**: `Ticket::getLeastBusyTechnician()` static method missing in Ticket model

### FIXES COMPLETED
- ✅ `routes/api.php` - Added complete ticket routes under `custom.auth` middleware
- ✅ `TicketController::store()` - Already existed, route now connected via API
- ✅ `TicketController::search()` - Added with keyword, priority, status, date range filtering
- ✅ `TicketController::startTicket()` - Added technician start repair workflow
- ✅ `TicketController::closeTicket()` - Fixed: now properly closes with minutes/cost/report
- ✅ `TicketController::requestBudget()` - Added technician budget request workflow
- ✅ `TicketController::scheduleTicket()` - Added scheduling with future date validation
- ✅ `TicketController::openTickets()` - Added listing for technician dashboard
- ✅ `Ticket::getLeastBusyTechnician()` - Added to Ticket model

### ✅ Phase 2: Unit Test Suite (Complete - 103 tests passed)
- [x] `Tests\Unit\TicketTest` (23 tests) - Constants, CRUD, workflow, budget, status transitions, soft deletes
- [x] `Tests\Unit\AuditableTraitTest` (7 tests) - Create/update/delete audit logs, metadata, error handling
- [x] `Tests\Unit\EquipmentTest` (8 tests) - CRUD, relationships (category, room, tickets), casts
- [x] `Tests\Unit\RoomTest` (6 tests) - CRUD, relationships (equipments, tickets), casts
- [x] `Tests\Unit\TicketCommentTest` (5 tests) - CRUD, relationships (ticket, user), multiple comments
- [x] `Tests\Unit\TicketAttachmentTest` (5 tests) - CRUD, relationships (ticket, user), multiple attachments
- [x] `Tests\Unit\TicketStatusTest` (5 tests) - CRUD, relationships (type, tickets), unique name constraint
- [x] `Tests\Unit\AIServiceTest` (5 tests) - No-tech, fallback, inactive tech, no-equipment, result structure
- [x] `Tests\Unit\TicketsExportTest` (7 tests) - Headings, mapping, null handling, query, styles, ordering
- [x] `Tests\Unit\ControllerHelpersTest` (8 tests) - Auth user, null auth, role validation, multiple roles, edge cases
- [x] `Tests\Unit\UserTest` (23 tests) - Profile validation, role checks, relationships, factory, API tokens
### ✅ Phase 3: Feature Test Suite (Complete - 53 tests passed)
- [x] `tests/Feature/TicketWorkflowFeatureTest.php` (9 tests) - Start/close/reopen/cancel workflow, RBAC, status validation
- [x] `tests/Feature/BudgetFeatureTest.php` (6 tests) - Budget request, admin approve/reject, RBAC, validation
- [x] `tests/Feature/CalendarFeatureTest.php` (3 tests) - Scheduled events listing, empty schedule, structure
- [x] `tests/Feature/AttachmentOperationFeatureTest.php` (5 tests) - Photo delete (own/other/tech), 404, listing
- [x] `tests/Feature/CommentOperationFeatureTest.php` (3 tests) - Add comment, validation, list comments
- [x] `tests/Feature/AdminCrudFeatureTest.php` (10 tests) - User/Equipment/Room CRUD, RBAC, inactivation
- [x] `tests/Feature/NotificationFeatureTest.php` (3 tests) - Status change, close, budget decision notifications
- [x] `tests/Feature/AuditFeatureTest.php` (4 tests) - List audits, audit on create/update, structure
- [x] `tests/Feature/ErrorScenarioFeatureTest.php` (10 tests) - 401/404/422/405, inactive user, nonexistent resources

### ✅ Phase 4: Security Test Suite (Complete - 27 tests passed)
- [x] `tests/Feature/SecurityRateLimitTest.php` (3 tests) - Login rate limiting, burst handling, per-IP independence
- [x] `tests/Feature/SecurityTokenTest.php` (5 tests) - Token length 60, uniqueness, regeneration, blank rejection
- [x] `tests/Feature/SecurityInputValidationTest.php` (6 tests) - SQL injection, XSS, HTML injection, mass assignment, unexpected fields, long input
- [x] `tests/Feature/SecurityCsrfTest.php` (4 tests) - CSRF exemption for login/API, auth required for logout/password change
- [x] `tests/Feature/SecurityPasswordPolicyTest.php` (4 tests) - Min 8 chars, confirmation mismatch, change min length, bcrypt hashing
- [x] `tests/Feature/SecuritySessionTest.php` (3 tests) - Logout clears session/token, new login new token
- [x] `tests/Feature/SecurityBruteForceTest.php` (3 tests) - Multiple failures, rapid requests, counter reset after success
- [ ] **Phase 5**: Validation & Edge Case Test Suite
- [ ] **Phase 6**: Integration/Export Test Suite
