# Authorization -- Automated Authorization Tests (RBAC)

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is part of "The Quality Assurance Lab." RBAC (Role-Based Access Control) means "permissions are based on your job role."

## What is this folder?

These tests verify the **role-based access control** system -- the rules that determine which person is allowed to do which things.

## The Three Roles

| Role | What They Can Do |
|------|------------------|
| **Admin** | Everything -- full control of the system |
| **Technician** | View and work on tickets, manage stock, view equipment |
| **Operator** | Report faults, view their own tickets, manage own profile |

## What Gets Tested

| Test | What It Verifies |
|------|------------------|
| `UiAuthorizationTest` | The web interface (pages) enforces role rules -- an Operator cannot access the Admin panel; unauthenticated users are redirected to login |

## Example Rules Verified

- An Operator cannot open the "User Management" page
- A Technician cannot create a new user
- An Admin can access everything
- Users cannot see other users' private data

## How to run these tests

```bash
# All authorization tests
php artisan test tests/Authorization

# A single test
php artisan test tests/Authorization --filter=UiAuthorizationTest
```
