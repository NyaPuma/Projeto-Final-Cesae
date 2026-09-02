# resources/views/components/ui/dashboard

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../../../../NON_TECHNICAL_PROJECT_GUIDE.md)

Dashboard-specific Blade components.

## Files

| File | Purpose |
|---|---|
| `welcome-panel.blade.php` | Welcome banner displayed at the top of the dashboard. Shows a greeting with the user's name, their active profile label, and a secure-access pill badge. |

## Notes for developers / AI

- All user-facing strings use `__()` translation calls.
- The component accepts `userName` and `profileLabel` props with safe defaults.
