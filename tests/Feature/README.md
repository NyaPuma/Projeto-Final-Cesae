# Feature -- Automated Feature (End-to-End) Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as part of "The Quality Assurance Lab" that tests complete user workflows end-to-end.

## What is this folder?

Feature tests simulate **real user journeys** -- exactly like a customer walking into a restaurant, ordering food, eating, paying, and leaving. They verify that all the pieces (form validation, authorization, business logic, database, and responses) work together correctly.

## What Gets Tested

### API Endpoints (app/Http/API/Controllers/)
Almost every API endpoint has a test file. These verify:
- **Successful operations** -- creating a ticket, updating equipment, etc.
- **Authorization rules** -- an Operator cannot do Admin things
- **Business rules** -- cannot close a cancelled ticket, budgets need approval, etc.
- **Error handling** -- what happens when invalid data is submitted
- **Edge cases** -- empty strings, negative numbers, missing fields
- **Response format** -- JSON structure is consistent and correct

### Web Pages & Views (Feature/Web/)
- **Page rendering** -- every page loads correctly
- **Form validation** -- forms reject invalid input
- **Authorization on pages** -- unauthenticated users are redirected to login
- **Design system** -- UI components render with correct structure

### Actions (Feature/Actions/)
- Individual action classes tested in context (CreateTicketAction, CreateUserAction)

### Middleware (Feature/Middleware/)
- CSRF protection, custom auth, rate limiting, role checks, and locale setting

### Domain Logic (Feature/Domain/)
- Ticket lifecycle (open → in-progress → closed), status checks, queries

### Repositories (Feature/Repositories/)
- Data access layer with real database interactions

## How to run these tests

```bash
# All feature tests
php artisan test tests/Feature

# A specific area
php artisan test tests/Feature/API/Controllers
php artisan test tests/Feature/Web/Controllers
php artisan test tests/Feature/Middleware

# A single test
php artisan test tests/Feature --filter=TicketWorkflowFeatureTest
```

> For a full list of individual test files and their locations, see the per-folder READMEs under `tests/Feature/` (e.g., `tests/Feature/API/README.md`, `tests/Feature/Web/README.md`).