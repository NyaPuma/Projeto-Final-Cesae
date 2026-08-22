# app/Repositories

Concrete repository implementations for data access. Each repository wraps an Eloquent model and implements the corresponding interface from `Contracts/`.

## Files

| File | Purpose |
|---|---|
| `EquipmentRepository.php` | CRUD operations for `Equipment` model with pagination |
| `RoomRepository.php` | CRUD operations for `Room` model, includes `getActive()` and `inactivate()` |
| `TicketRepository.php` | CRUD operations for `Ticket` model, plus queries for open tickets, tickets by technician, and tickets by user |
| `UserRepository.php` | CRUD operations for `User` model, plus `getActiveTechnicians()`, `getAdmins()`, `findByEmail()`, and `inactivate()` |

## Notes for developers / AI

- All classes are `final` and implement their respective `Contracts/` interface.
- Each repository uses `LengthAwarePaginator` with a default of 15 items per page.
- Method `{@inheritDoc}` docblocks delegate documentation to the interface.
- No raw SQL — all queries use Eloquent.
