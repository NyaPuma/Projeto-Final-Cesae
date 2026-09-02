# Fixtures -- Test Helpers & Data Builders

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "The Props and Scripts" used during testing.

## What is this folder?

These are the **support tools** that make testing faster and cleaner. They include fake data generators, reusable helpers, and mock replacements for external services.

## What's Inside

| Folder/File | Purpose |
|-------------|---------|
| `Builders/` | Create test data with specific configurations (e.g., "a high-priority ticket assigned to a specific technician") |
| `Datasets/` | Reference data for testing (all possible priority levels, statuses, and roles) |
| `Fakes/` | Mock replacements for external services (e.g., a fake notification service that doesn't actually send emails) |
| `Helpers/` | Common test utilities (API interaction, event simulation, storage management) |

## Common Test Helpers (in `tests/Base/` and `tests/Concerns/`)

| Concern | What It Provides |
|---------|------------------|
| `CreatesUsers` | Quickly creates test users with specific roles |
| `CreatesTickets` | Quickly creates test tickets with settings |
| `CreatesEquipment` | Quickly creates test equipment records |
| `InteractsWithApi` | Simulates API calls for testing endpoints |
| `InteractsWithMail` | Captures and inspects emails that "would have been sent" |
| `InteractsWithEvents` | Captures and inspects events that "would have fired" |
| `InteractsWithQueue` | Simulates background job processing |
| `InteractsWithStorage` | Simulates file storage for upload tests |
| `InteractsWithNotifications` | Captures and inspects notifications |

**Note:** These files are not run as standalone tests -- they are included by other test files to reduce duplication.
