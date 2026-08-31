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

## Behaviour conventions under test

Some suites assert app behaviour that has specific conventions worth knowing before changing either side:

- **Auth message strings** (`AuthFlowTest`, `AuthEdgeCasesTest`) expect English messages and call `app()->setLocale('en-GB')` in `setUp()` because the app's default locale is pt-PT.
- **Password reset mail** (`PasswordResetFlowTest`) uses `Mail::assertQueued(...)` — `App\Mail\PasswordResetMail` implements `ShouldQueue`, so the mailable is always queued. The controller looks the user up by a case-normalised email (`strtolower(trim(...))`) so uppercase input still resolves the account.
- **Analytics cache key** (`DatabaseOptimizationTest`) asserts `Cache::has('analytics_dashboard_payload:' . app()->getLocale())` — this matches the locale-suffixed key used by `AnalyticsDashboardService` (and cleared by `TicketObserver`).
- **Inline scripts in views** (`AssetPipelineTest`) allow exactly three sanctioned patterns: the synchronous anti-FOUC theme script in `<head>` (contains `prefers-color-scheme` and `localStorage.getItem('theme')`), the i18n bootstrap (`window.SGM_*`), and non-executing data blocks (`<script type="application/json">`). The anti-FOUC layout check inspects the auth shell component (`ui/components/auth/shell.blade.php`) where that `head` actually lives.
- **Design-system components** (`DesignSystemComponentsTest`) call the top-level aliases `<x-button.button>`, `<x-card.card>`, `<x-card.badge>`, `<x-card.alert>` and `<x-input.input>`, implemented under `resources/views/components/{button,card,input}/`.
- **Audit changes** (`AuditTrailTest`) fall back to `getDirty()` when `getChanges()` is empty, so updated attributes are always recorded in `old_values` / `new_values`.
