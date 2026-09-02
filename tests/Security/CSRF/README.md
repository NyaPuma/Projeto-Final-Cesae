# CSRF -- Automated Security Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Penetration Testing Team" that tries to break into the system to find vulnerabilities.

## What is this folder?

**Cross-Site Request Forgery (CSRF)** -- A malicious third-party website cannot trick a logged-in user's browser into performing actions they didn't intend.

## What Gets Tested

The test files in this folder simulate attacks of this type and verify the system successfully blocks them.

## How to run these tests

```bash
# All tests in this security area
php artisan test tests/Security/CSRF

# A specific test
php artisan test tests/Security/CSRF --filter=TestName
```
