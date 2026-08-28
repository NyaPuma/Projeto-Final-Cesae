# Feature

Feature (integration) tests exercising the full Laravel stack: HTTP endpoints, actions, domain logic, and middleware.

| Entry | Purpose |
|-------|---------|
| `Actions/` | Feature tests for action classes (user/ticket creation flows) |
| `API/` | API endpoint feature tests (controllers and routing/docs) |
| `Console/` | Artisan console command feature tests |
| `Domain/` | Domain-logic feature tests (ticket lifecycle, queries, priority checks) |
| `Middleware/` | HTTP middleware feature tests (auth, CSRF, locale, rate limit, roles) |
| `Repositories/` | Repository feature tests |
| `Validation/` | Validation edge-case feature tests |
| `Web/` | Web (controller/Blade) feature tests |
| `UserPreferencesTest.php` | Feature tests for user preference persistence/retrieval |
