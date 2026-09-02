# Security -- Automated Security Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "The Penetration Testing Team" that tries to break into the system to find vulnerabilities.

## What is this folder?

These tests simulate cyberattacks to verify the system resists real-world threats. Just like a bank hires security experts to test its locks, this codebase has automated tests that attempt to break in -- and every test must fail to break in.

## Security Coverage (OWASP Top 10)

| Folder | Attack Simulated | What It Verifies |
|--------|------------------|------------------|
| `SQLInjection/` | SQL Injection | An attacker cannot steal or corrupt database data by typing malicious database commands into forms |
| `XSS/` | Cross-Site Scripting | An attacker cannot inject harmful scripts into web pages that run for other users |
| `CSRF/` | Cross-Site Request Forgery | A malicious website cannot trick a logged-in user's browser into making forbidden actions |
| `IDOR/` | Insecure Direct Object Reference | A user cannot access another user's data by changing IDs in the URL |
| `Password/` | Password Attacks | Passwords are stored securely; the 5-attempt/15-minute lockout works |
| `RateLimiting/` | Brute Force / Spam | An attacker cannot hammer the login form with thousands of guesses |
| `Session/` | Session Hijacking | User sessions are protected from being stolen or reused |
| `PrivilegeEscalation/` | Privilege Escalation | A regular user cannot gain admin powers |
| `MassAssignment/` | Mass Assignment | A user cannot change fields they should not be allowed to set |
| `PathTraversal/` | Path Traversal | An attacker cannot access files outside the allowed folder |
| `FileUpload/` | Malicious Uploads | Only safe file types (images, documents) can be uploaded; size limits enforced |
| `UserEnumeration/` | User Discovery | An attacker cannot tell which email addresses have accounts |
| `Headers/` | Security Headers | HTTP security headers (CSP, HSTS, X-Frame-Options) are correctly configured |
| `APITokens/` | Token Theft | API tokens are stored and transmitted securely |
| `Authentication/` | Auth Bypass | Users cannot bypass login or steal tokens |
| `Authorization/` | Auth Bypass | Users cannot access resources without proper permissions |
| `Tokens/` | Token Security | Reset/token system is protected from tampering |

## How to run these tests

```bash
# All security tests
php artisan test tests/Security

# A specific security area
php artisan test tests/Security/SQLInjection
php artisan test tests/Security/XSS
php artisan test tests/Security/RateLimiting

# A single test
php artisan test tests/Security --filter=SqlInjectionTest
```