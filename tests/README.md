# tests

Root of the test suite: feature, unit, integration, performance, security and database tests.

| Entry | Purpose |
|-------|---------|
| `Authentication/` | Authentication flow tests (login, registration, password reset, edge cases) |
| `Authorization/` | UI-level authorization checks |
| `Base/` | Abstract base test case classes (`DatabaseTestCase`, `FeatureTestCase`, `UnitTestCase`) |
| `Concerns/` | Reusable testing traits (data creation, API/mail/event/storage interactions) |
| `Database/` | Database-layer tests (constraints, migrations, seeders) |
| `Feature/` | Feature/integration tests (HTTP endpoints, actions, domain, middleware) |
| `Fixtures/` | Test fixtures (builders, datasets, fakes, helpers) |
| `Integration/` | Cross-component integration tests (broadcasting, database, mail) |
| `Performance/` | Performance/load-oriented suites (queries, memory, scalability, search…) |
| `Security/` | Security suites (XSS, SQL injection, CSRF, IDOR, mass assignment…) |
| `Unit/` | Unit tests organized by application layer |
| `TestCase.php` | Base test case; flushes the ticket-status cache and stubs the Vite build manifest |

**Notes:** PHPUnit-based suite (see `phpunit.xml` at repo root); no JavaScript/Vitest tests live under this directory. Test data relies on factories and the fixture builders in `Fixtures/`. Run with `php artisan test`.
