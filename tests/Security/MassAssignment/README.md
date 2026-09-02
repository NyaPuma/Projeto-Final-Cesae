# MassAssignment -- Automated Security Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Penetration Testing Team" that tries to break into the system to find vulnerabilities.

## What is this folder?

**Mass Assignment** -- A user cannot set fields they are not allowed to set (e.g., changing their own role to admin via a form).

## What Gets Tested

The test files in this folder simulate attacks of this type and verify the system successfully blocks them.

## How to run these tests

```bash
# All tests in this security area
php artisan test tests/Security/MassAssignment

# A specific test
php artisan test tests/Security/MassAssignment --filter=TestName
```
