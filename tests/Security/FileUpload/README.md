# FileUpload -- Automated Security Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this is part of "The Penetration Testing Team" that tries to break into the system to find vulnerabilities.

## What is this folder?

**File Upload Security** -- Only safe, allowed file types (images, documents) can be uploaded; dangerous files and oversized uploads are rejected.

## What Gets Tested

The test files in this folder simulate attacks of this type and verify the system successfully blocks them.

## How to run these tests

```bash
# All tests in this security area
php artisan test tests/Security/FileUpload

# A specific test
php artisan test tests/Security/FileUpload --filter=TestName
```
