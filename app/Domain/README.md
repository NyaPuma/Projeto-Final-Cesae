# app/Domain

Domain-specific business logic organized by bounded context.


## Subdirectories


| Directory | Purpose |
|---|---|
| `Ticket/` | Ticket domain logic — actions, DTOs, value objects, and workflow services specific to ticket management. |


## Notes for developers / AI

- This follows a DDD-lite structure where domain logic is grouped by entity rather than by layer.
- Each domain subdirectory (e.g., `Ticket/`) contains its own Actions, DTOs, and ValueObjects.
