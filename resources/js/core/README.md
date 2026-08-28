# resources/js/core

Core JavaScript managers providing shared functionality.

| File | Purpose |
|------|---------|
| `auth.js` | Auth state management, token refresh, session guards |
| `dropdown-manager.js` | Reusable dropdown with A11y, CSS state, and keyboard navigation |
| `layout.js` | Layout interactions (sidebar toggles, theme, notifications modal) |
| `navigation-manager.js` | Keyboard/index navigation with loop support |
| `search-engine.js` | Local + remote search with caching and abort support |
| `sidebar.js` | Desktop/mobile sidebar management and bfcache handling |
| `theme.js` | Theme system (preset management, dark/light toggle, CSS variable application) |

## Recent Refactorings

- `auth-box.js`: Swapped base-palette hover colors (`hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400`) for the design `danger` token (`hover:bg-danger/10 hover:text-danger`), which auto-adapts to dark mode.
- `auth-box.js`, `auth.js`, `dropdown-manager.js`, `layout.js`, `navigation-manager.js`, `search-engine.js`, `sidebar.js`, `theme.js`: No further changes — pure state/logic modules with no markup or inline styling.
