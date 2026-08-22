# app/Repositories/Contracts

Interface contracts for the repository layer. Each interface defines the data access methods that concrete repositories must implement.

## Files

| File | Purpose |
|---|---|
| `EquipmentRepositoryInterface.php` | Contract for equipment CRUD operations |
| `RoomRepositoryInterface.php` | Contract for room CRUD operations, including active room filtering and inactivation |
| `TicketRepositoryInterface.php` | Contract for ticket CRUD operations, plus open ticket queries, technician assignment queries, and user-scoped queries |
| `UserRepositoryInterface.php` | Contract for user CRUD operations, plus technician/admin listing, email lookup, and inactivation |

## Notes for developers / AI

- All interfaces use `LengthAwarePaginator` for paginated results.
- PHPDoc `@param` / `@return` types are documented on every method for IDE support.
- Implementations live in `app/Repositories/`.
