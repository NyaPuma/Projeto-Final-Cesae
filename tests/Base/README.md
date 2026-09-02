# Base -- Shared Test Base Classes

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- these are the "foundations" that all tests stand on.

## What is this folder?

These are the **base classes** that all other tests extend. They set up a clean testing environment so each test starts from a known, predictable state.

## Files

| File | Purpose |
|------|---------|
| `UnitTestCase.php` | Base class for **unit tests** (tests individual pieces in isolation; no database needed) |
| `FeatureTestCase.php` | Base class for **feature tests** (tests complete user workflows with a test database and HTTP simulation) |
| `DatabaseTestCase.php` | Base class for **database tests** (sets up a real (in-memory) database, runs migrations and seeds before each test) |

## How They Work

1. Each test file extends one of these base classes
2. Before each test, the base class:
   - Creates a fresh test database
   - Runs migrations (builds all tables)
   - Seeds reference data (roles, statuses, categories)
   - Sets up the testing environment
3. After each test, the database is reset so the next test starts clean

**Why this matters:** Between tests, the data is completely reset -- no test can accidentally affect another test. This ensures every test gives reliable, repeatable results.
