# Database -- Automated Database Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as part of "The Quality Assurance Lab." These tests verify that data stays correct, relationships hold, and the schema is valid.

## What is this folder?

These tests verify the **integrity of the database** -- the filing cabinet that stores all the company's data. They ensure that:

1. The database **structure** (schema) matches what the code expects
2. **Relationships** between records are correct (a ticket really belongs to a user; deleting a room doesn't orphan equipment)
3. **Business rules** are enforced (audit records cannot be changed; budget calculations are accurate)
4. **Migrations** run correctly and don't break existing data
5. **Seeders** create valid reference data

## What Gets Tested

| Test | What It Verifies |
|------|------------------|
| `AuditTrailTest` | Audit records are immutable -- nobody can change or delete them |
| `BudgetCalculationTest` | Budget amounts are calculated correctly |
| `RelationshipIntegrityTest` | Data relationships hold (foreign keys, cascading) |
| `ConcurrencyTest` | Multiple users can't corrupt data simultaneously |
| `DatabaseIntegrityTest` | No orphaned or invalid data records |
| `WorkflowPersistenceTest` | Ticket workflow states survive save/load cycles |
| `AttachmentPersistenceTest` | Ticket attachments are persisted correctly |
| `CastIntegrityTest` | Data types are stored and retrieved correctly |
| `TokenIntegrityTest` | Security tokens are stored and verified correctly |
| `ModelLifecycleTest` | Models go through their lifecycle correctly (create → update → soft-delete) |
| `DatabaseOptimizationTest` | Database queries are efficient |
| `DatabaseSchemaValidationTest` | The schema matches the expected structure |
| `ComplianceSeedersTest` | Seed data complies with business rules |

## How to run these tests

```bash
# All database tests
php artisan test tests/Database

# A specific area
php artisan test tests/Database/Constraints
php artisan test tests/Database/Migrations
php artisan test tests/Database/Seeders

# A single test
php artisan test tests/Database --filter=AuditTrailTest
```