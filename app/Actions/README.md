# app/Actions

Single-responsibility action classes that encapsulate business operations. Each action performs one use case and is injected via constructor with its dependencies.

## Files

| File | Purpose |
|---|---|
| `ApproveBudgetAction.php` | Approves or rejects a pending budget request on a ticket. Notifies the requester. |
| `AssignTechnicianAction.php` | Assigns or removes a technician from a ticket via `TechnicianAssignmentService`. |
| `CreateEquipmentAction.php` | Creates a new equipment record within a transaction. |
| `CreatePartAction.php` | Creates a new part and optionally records an initial stock movement if `currentStock > 0`. |
| `CreatePreventiveTicketAction.php` | Creates a preventive maintenance ticket, optionally assigned to a technician and scheduled. |
| `CreatePublicTicketAction.php` | Creates a ticket reported publicly via QR code, without requiring a user account. |
| `CreateRoomAction.php` | Creates a new room/physical location record. |
| `CreateSupplierAction.php` | Creates a new supplier record. |
| `CreateTicketAction.php` | Creates a standard incident ticket for an authenticated user. |
| `CreateUserAction.php` | Creates a new user with hashed password within a transaction. |
| `MaintenancePlanActions.php` | CRUD operations for maintenance plans and their associated parts (create, update, sync). |
| `PartCategoryActions.php` | CRUD operations for part categories (create, update). |
| `ScheduleMaintenanceAction.php` | Creates a preventive maintenance ticket pre-scheduled on the calendar. |
| `ScheduleTicketAction.php` | Schedules an existing ticket with start/end timestamps. Prevents scheduling closed tickets. |
| `SubmitBudgetAction.php` | Submits a budget request on a ticket. Prevents duplicates and submission on closed tickets. |
| `TaxRateActions.php` | CRUD operations for tax rates with default-rate management. |
| `UpdateEquipmentAction.php` | Updates an existing equipment record. |
| `UpdatePartAction.php` | Updates an existing part record. |
| `UpdateRoomAction.php` | Updates an existing room record. |
| `UpdateSupplierAction.php` | Updates an existing supplier record. |
| `UpdateUserAction.php` | Updates an existing user's profile data. |

## Notes for developers / AI

- All actions are `final readonly` classes with a single `execute()` method (or named methods for multi-operation classes like `MaintenancePlanActions`).
- Actions use `DB::transaction()` for multi-model operations to ensure atomicity.
- Several actions depend on `TicketStatusService::getByName()` to resolve enum values to database IDs — this throws `RuntimeException` if the status doesn't exist in the database.
- Guard clauses at the top of methods validate preconditions before proceeding (e.g., cannot schedule a closed ticket, cannot submit duplicate budget requests).
- The `__('...')` calls reference translation keys from `lang/` — these are intentionally left as-is for i18n purposes.
