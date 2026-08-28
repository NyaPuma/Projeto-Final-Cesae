# resources

Frontend source assets for the application: Blade views, JS/CSS assets compiled by Vite, and internal docs.

| Item | Purpose |
|------|---------|
| `views/` | Blade templates: main layout, calendar, layouts, emails, errors, preferences, reports, UI components |
| `js/` | Frontend JavaScript source (Alpine, API client, page modules) compiled by Vite |
| `css/` | Frontend stylesheets (design tokens, theme, layout, pages) compiled by Vite |
| `docs/` | Internal design documentation in Markdown |

## Notes

- JS and CSS are entry points/inputs for the Vite build; do not edit files in `public/build` directly.
- Each subdirectory has its own `README.md` with details.
