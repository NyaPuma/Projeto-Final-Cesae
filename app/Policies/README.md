# app/Policies

Authorization policies defining which users can perform actions on each model.

## Files

| File | Purpose |
|---|---|
| `AuditPolicy.php` | Only admins can view audit records |
| `EquipmentPolicy.php` | Admin/technician can view; admin-only for CRUD + manage/compatibility methods |
| `MaintenancePlanPolicy.php` | Admin/technician can view; admin-only for CRUD |
| `PartCategoryPolicy.php` | Admin/technician can view; admin-only for CRUD |
| `PartPolicy.php` | Admin/technician can view; admin-only for CRUD |
| `RoomPolicy.php` | Admin/technician can view; admin-only for CRUD + manage/compatibility methods |
| `StockMovementPolicy.php` | Admin/technician can view and create; admin-only for delete |
| `SupplierPolicy.php` | Admin/technician can view; admin-only for CRUD |
| `TaxRatePolicy.php` | Admin/technician can view; admin-only for CRUD |
| `TicketPolicy.php` | Full lifecycle: view (all), create (all), update (admin/tech), delete (admin), cancel (own ticket), start/close (tech), reopen (tech/admin), schedule, budget, assign (admin), analytics (admin), preventive (admin) |
| `UserPolicy.php` | Admin/technician can view; admin-only for create/delete/inactivate; users can update own profile |
| `UserProfilePolicy.php` | Only admins can list profiles |

## Notes for developers / AI

- All policies are `final` classes with no constructor injection.
- `TicketPolicy` is the most complex with 20 methods covering the full ticket lifecycle.
- `TicketPolicy::canAccessTicket()` is a private helper that checks admin/technician/creator access.
- `EquipmentPolicy` and `RoomPolicy` include `manage()`/`manageAny()` compatibility methods.
- `UserPolicy::delete()` prevents self-deletion.
- `UserPolicy::inactivate()` prevents admin-to-admin inactivation.
