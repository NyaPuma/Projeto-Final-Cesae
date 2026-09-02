# Authentication Performance -- Automated Performance Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Quality Assurance Lab." Performance tests check that the system stays fast even as it grows.

## What is this folder?

Performance tests for **Authentication Performance** -- login/register requests stay fast even under load. These verify the system's speed and responsiveness.

## What Gets Tested

The tests measure response times, resource usage, and throughput to ensure the system remains performant.

## How to run these tests

```bash
# All tests in this folder
php artisan test tests/Performance/Authentication

# A specific test
php artisan test tests/Performance/Authentication --filter=TestName
```
