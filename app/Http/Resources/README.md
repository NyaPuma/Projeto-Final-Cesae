# app/Http/Resources

API resource (transformer) classes for converting Eloquent models to JSON responses.

## Purpose

Each resource class defines how a model is serialized for API output, following Laravel's API Resource pattern. They provide consistent JSON structure across all endpoints.

## Structure

Resources map directly to their corresponding models:
- `AuditResource` → `Audit` model
- `EquipmentResource` → `Equipment` model
- `TicketResource` → `Ticket` model
- `UserResource` → `User` model
- etc.

## Key Patterns

- Each resource has a `toArray(Request $request): array` method
- Maps model attributes to a consistent JSON structure
- Uses `$this->property` syntax for attribute access
- Some resources delegate to Enum `label()` methods for user-facing display values

## Notes

- Enum `label()` values are user-facing — part of the i18n domain
- `nif` (SupplierResource) is a database column name (Portuguese tax ID acronym) — DB-level naming, reported separately
