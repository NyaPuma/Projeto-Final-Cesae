# resources/js

Client-side JavaScript modules for the application frontend.

## Structure

| Directory | Purpose |
|-----------|---------|
| `auth/` | Authentication UI (login form, password strength, utilities) |
| `bootstrap/` | App initialization and bootstrap logic |
| `components/` | Reusable UI components (inputs, listing, modals) |
| `core/` | Core managers (auth, navigation, theme, notifications, sidebar, etc.) |
| `pages/` | Page-specific scripts organized by feature |
| `services/` | Service layer for API interactions |
| `utils/` | Utility functions (API client, locale formatting, etc.) |

## Root Files

| File | Purpose |
|------|---------|
| `analytics.js` | Global analytics initialization |
| `api-client.js` | Centralized fetch wrapper with auth, interceptors, and error handling |
| `early-theme.js` | Preloads theme to prevent flash of unstyled content (FOUC) |

## Recent Refactorings

- Root files (`alpine.js`, `analytics.js`, `api-client.js`, `app.js`, `early-theme.js`): No changes needed — all are plain infrastructure/bootstrap modules with no inline styles, no hardcoded design classes, and no typography or button markup concerns.
