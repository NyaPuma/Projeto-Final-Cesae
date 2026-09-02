# resources/views/errors

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Custom error page templates extending the `errors.minimal` base layout.

## Files

| File | Purpose |
|---|---|
| `402.blade.php` | Payment Required error page. |
| `403.blade.php` | Forbidden error page. |
| `404.blade.php` | Not Found error page. |
| `500.blade.php` | Internal Server Error page. |
| `minimal.blade.php` | Base error layout shared by all error pages. Renders a semantic error badge, title, message, a "go home" recovery link, and an optional technical details box when `$exception->getMessage()` is present. |

## Notes for developers / AI

- The numbered error pages only contain `@extends`, `@section` and `__()` calls — all user-facing strings go through translation.
- `minimal.blade.php` handles the JS-driven dynamic recovery button (`error-recovery-btn` / `error-recovery-text`).
- The error layout extends `ui.layout`, so changes to the base layout will affect error pages too.

## Recent Refactorings

- `minimal.blade.php`: Error badge moved from `red-500` to the `danger` token (`border-danger/20 bg-danger/10 text-danger`); technical-info icon from `amber-500` to `warning` (`bg-warning/10 text-warning`) — both auto-adapt in dark mode.
- `402/403/404/500.blade.php`: no changes — pure `@extends`/`@section`/`__()` wrappers.
