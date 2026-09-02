# Headers -- Automated Security Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Penetration Testing Team" that tries to break into the system to find vulnerabilities.

## What is this folder?

**Security Headers** -- HTTP security headers (CSP, HSTS, X-Frame-Options, etc.) are correctly configured on responses.

## What Gets Tested

The test files in this folder simulate attacks of this type and verify the system successfully blocks them.

## How to run these tests

```bash
# All tests in this security area
php artisan test tests/Security/Headers

# A specific test
php artisan test tests/Security/Headers --filter=TestName
```
