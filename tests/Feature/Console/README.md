# Console -- Automated Artisan Command Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab."

Tests for the **Artisan console commands** -- the text-based commands developers run to manage the system (e.g., `php artisan ticket:reopen-stale`).

| Test | What It Verifies |
|------|------------------|
| `ReopenStaleTicketsTest` | The "reopen stale tickets" command works correctly |
| `CheckOverdueTicketsTest` | The "check overdue tickets" command works correctly |
| `SendEscalationRemindersTest` | The "send escalation reminders" command sends the right emails |

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Feature/Console

# A single test
php artisan test tests/Feature/Console --filter=TestName
```
