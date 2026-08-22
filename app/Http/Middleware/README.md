# app/Http/Middleware

HTTP middleware classes for request processing in the SGM maintenance management platform.

## Purpose

Middleware sits between the HTTP request and the controller, performing cross-cutting concerns like authentication, CSRF protection, rate limiting, and security headers.

## Files

| File | Purpose |
|------|---------|
| `CsrfMiddleware` | CSRF token validation for state-changing requests |
| `CustomAuthMiddleware` | Token-based authentication (header, bearer, cookie, session) |
| `LocalizeSwaggerDocument` | Translates OpenAPI/Swagger document fields to current locale |
| `RateLimitMiddleware` | Per-user/IP rate limiting with configurable limits |
| `RoleMiddleware` | Role-based access control (checks user profile name) |
| `SecurityHeaders` | Adds HTTP security headers (CSP, HSTS, X-Frame-Options, etc.) |
| `SetLocaleMiddleware` | Resolves and sets application locale from session/cookie/user/browser |
| `SetUserPreferencesMiddleware` | Sets user preferences (language, currency, date format) |

## Key Patterns

- **`handle()`** — Main method that processes the request and calls `$next($request)`
- **`__()` translation keys** — Used for user-facing error messages (i18n domain)
- **Response helpers** — Each middleware has private methods for building specific responses (e.g., `unauthenticatedResponse`, `expiredTokenResponse`)
- **Precedence chain** — `SetLocaleMiddleware` and `SetUserPreferencesMiddleware` resolve locale with session → cookie → user DB → browser → default

## Notes

- `__()` translation keys are part of the i18n domain — not normalized in this refactor
- `LocalizeSwaggerDocument::SOURCE_DOMAINS` maps source strings to translation domains — i18n domain
- `SetLocaleMiddleware::DEFAULT_LOCALE` is `'pt-PT'` — DB-level default, reported separately
