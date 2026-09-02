# resources/docs

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md)

Internal design documentation for the frontend.

| File | Purpose |
|------|---------|
| `design-notes.md` | Design token plan and decisions: color palette, typography, layout, dark/light themes, CSS architecture, accessibility (WCAG 2.1 AA), and system/theme settings behavior |

## Notes

- The color/token values documented here are implemented as single source of truth in `resources/css/tokens.css`.
- Server-side theme generation referenced in the doc lives in `app/Services/ThemePresetService.php`.
