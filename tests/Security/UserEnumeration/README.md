# UserEnumeration -- Automated Security Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Penetration Testing Team" that tries to break into the system to find vulnerabilities.

## What is this folder?

**User Enumeration** -- An attacker cannot tell which email addresses have registered accounts (responses don't reveal this).

## What Gets Tested

The test files in this folder simulate attacks of this type and verify the system successfully blocks them.

## How to run these tests

```bash
# All tests in this security area
php artisan test tests/Security/UserEnumeration

# A specific test
php artisan test tests/Security/UserEnumeration --filter=TestName
```
