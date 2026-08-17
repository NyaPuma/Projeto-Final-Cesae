# app/DTOs

Immutable Data Transfer Objects used to carry validated, sanitized input from the HTTP layer (FormRequest or plain arrays) into Actions and Services. All DTOs are `final readonly` PHP classes.

## Files

| File | Purpose |
|---|---|
| [`AssignTechnicianData.php`](AssignTechnicianData.php) | Carries the optional technician ID for ticket assignment. Validates ID is a positive integer. |
| [`BudgetDecisionData.php`](BudgetDecisionData.php) | Approval/rejection decision for a budget request, with optional feedback text. Wraps `BudgetDecisionEnum`. |
| [`BudgetSubmissionData.php`](BudgetSubmissionData.php) | Estimated budget amount and optional details. Two factory methods: `fromSubmitEstimate()` and `fromDetailedRequest()`. Handles comma-decimal input normalization. |
| [`CloseTicketData.php`](CloseTicketData.php) | Data required to close a ticket: actual cost, optional technical report, and force-close flag. |
| [`CommentData.php`](CommentData.php) | Sanitized ticket comment content. Rejects empty strings. |
| [`CreateTicketData.php`](CreateTicketData.php) | New ticket payload: title, description, priority enum, optional equipment/room IDs. |
| [`PasswordChangeData.php`](PasswordChangeData.php) | Current and new password for a password-change flow. Validates new ≠ current. |
| [`ProfileUpdateData.php`](ProfileUpdateData.php) | Partial profile update (name, e-mail). `toArray()` returns only non-null fields to prevent accidental overwrites. |
| [`ScheduleMaintenanceData.php`](ScheduleMaintenanceData.php) | Intervention scheduling payload: title, equipment ID (required), scheduled datetime, optional assignee and description. |
| [`ScheduleTicketData.php`](ScheduleTicketData.php) | Ticket scheduling window: `scheduledAt` (required) and optional `scheduledEnd`. Validates end is not before start. |
| [`StoreEquipmentData.php`](StoreEquipmentData.php) | Full creation payload for an equipment record. Validates against `STATUSES` const (DB enum values — kept in Portuguese, see note below). |
| [`StorePartData.php`](StorePartData.php) | Creation payload for a spare-part record. Validates initial stock ≥ 0. |
| [`StoreRoomData.php`](StoreRoomData.php) | Creation payload for a room. Validates name is non-empty and capacity ≥ 0. |
| [`StoreSupplierData.php`](StoreSupplierData.php) | Creation payload for a supplier record (name, NIF, contact, e-mail, address, lead time). |
| [`StoreUserData.php`](StoreUserData.php) | New user creation payload: name, e-mail, password, optional profile ID and active flag. |
| [`TicketFilters.php`](TicketFilters.php) | Optional filter set for ticket listing queries. `toArray()` returns only active filters. Validates `dateFrom` ≤ `dateTo`. |
| [`UpdateEquipmentData.php`](UpdateEquipmentData.php) | Partial update payload for an equipment record. All fields nullable; `toArray()` omits nulls. |
| [`UpdatePartData.php`](UpdatePartData.php) | Full update payload for a spare-part record (includes all editable fields). |
| [`UpdateRoomData.php`](UpdateRoomData.php) | Partial update payload for a room. All fields nullable. |
| [`UpdateSupplierData.php`](UpdateSupplierData.php) | Full update payload for a supplier record. |
| [`UpdateUserData.php`](UpdateUserData.php) | Partial user update. Password handled separately via `hasPassword()`. `toArray()` excludes password for safety. |

## Notes for developers / AI

- **Convention:** Every DTO exposes a static `fromRequest(FormRequest|array $data)` factory. Pass either a `FormRequest` (it calls `->validated()`) or a plain array (e.g. in tests or seeders).
- **`toArray()` semantics vary by DTO:** Some (Store*) return all fields; partial-update DTOs (Update*, ProfileUpdateData) filter out `null` values so Eloquent only touches provided fields.
- **`StoreEquipmentData::STATUSES`** contains Portuguese string values (`operacional`, `manutenção`, `avariado`, `abatido`). These match the database `status` column's allowed values and must **not** be renamed until the schema is migrated (tracked in `docs/refactor/db-naming-report.md`).
- **No behavior in DTOs.** DTOs are validation + sanitization containers only. Business logic belongs in Actions and Services.
