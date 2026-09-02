# RateLimiting -- Automated Security Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Penetration Testing Team" that tries to break into the system to find vulnerabilities.

## What is this folder?

**Rate Limiting / Brute-Force Protection** -- An attacker cannot hammer login or sensitive endpoints with thousands of requests in a short time.

## What Gets Tested

The test files in this folder simulate attacks of this type and verify the system successfully blocks them.

## How to run these tests

```bash
# All tests in this security area
php artisan test tests/Security/RateLimiting

# A specific test
php artisan test tests/Security/RateLimiting --filter=TestName
```
