# Unit -- Automated Unit Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as part of "The Quality Assurance Lab." Unit tests are ISOlated tests -- like testing that a car's engine works without needing to drive the whole car.

## What is this folder?

Unit tests verify each individual component **in isolation** -- no external dependencies, no database, no emails actually sent. They answer question: "Does this one piece work correctly on its own?"

## What Gets Tested

| Folder | What Each Test Verifies |
|--------|------------------------|
| `Actions/` | Each action class (create ticket, approve budget, schedule maintenance) works correctly |
| `DTOs/` | Data packages validate and sanitize input correctly (reject bad data, accept good data) |
| `Enums/` | Enum values, labels, colors, and normalization work correctly |
| `Models/` | Database model relationships, accessors, and behaviors |
| `Services/` | Business logic services (budget calculation, notifications, AI, search) |
| `Policies/` | Access control rules (who can view/edit/delete what) |
| `Observers/` | Watchdog behaviors (audit recording, cache invalidation) |
| `Jobs/` | Background tasks (exports, AI recommendations) |
| `Listeners/` | Follow-up reactions (logging status changes, notifying technicians) |
| `Mail/` | Email templates render correctly |
| `Events/` | Event payloads and broadcast names are correct |
| `Traits/` | Shared behaviors work when attached to models |
| `ValueObjects/` | Special values (Email, Money, SerialNumber) validate correctly |
| `Console/` | Artisan commands work |
| `Exports/` | Data export formatting |
| `Middleware/` | Security guards and locale detection |
| `Repositories/` | Data access methods |
| `Providers/` | Service wiring |

## How to run these tests

```bash
# All unit tests
php artisan test tests/Unit

# A specific area
php artisan test tests/Unit/Models
php artisan test tests/Unit/Actions
php artisan test tests/Unit/Services

# A single test
php artisan test tests/Unit --filter=BudgetCalculatorServiceTest
```