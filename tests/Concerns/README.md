# Concerns -- Shared Test Concerns (Reusable Helpers)

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- these are reusable "helper tools" that make writing tests faster and less repetitive.

## What is this folder?

These are **traits (reusable code blocks)** that test files include to quickly create test entities (users, tickets, equipment) and mock helper services. Instead of writing the same setup code in every test, test files import these concerns.

## What's Included

| Concern | Purpose |
|---------|---------|
| `CreatesUsers` | Quickly creates test users with a specific role and profile |
| `CreatesTickets` | Quickly creates test tickets with a specific status/priority |
| `CreatesEquipment` | Quickly creates test equipment records |
| `InteractsWithApi` | Simulates authenticated API calls |
| `InteractsWithMail` | Captures and inspects email "sent" during a test |
| `InteractsWithEvents` | Captures and inspects events fired during a test |
| `InteractsWithQueue` | Simulates background job processing |
| `InteractsWithStorage` | Simulates file storage for upload tests |
| `InteractsWithNotifications` | Captures and inspects notifications sent during a test |

**Note:** These are not standalone tests -- they are included by other test files to remove duplication.
