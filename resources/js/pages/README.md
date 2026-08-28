# resources/js/pages

Page-specific JavaScript modules, organized by feature.

| Directory | Purpose |
|-----------|---------|
| `analytics/` | Analytics dashboard (charts, KPIs, export, activity) |
| `audits/` | Audit log management |
| `equipments-management/` | Equipment CRUD with pagination and filters |
| `rooms-management/` | Room management |
| `stock/` | Stock management (movements, parts, plans, suppliers) |
| `ticket-create/` | Ticket creation form |
| `ticket-detail/` | Ticket detail view (workflow, budget, comments) |
| `tickets-management/` | Ticket listing and management |
| `users-management/` | User CRUD |
| Root files | Settings pages (appearance, system), profile, Swagger i18n |

## Recent Refactorings

All base-palette colors in JS-rendered markup were migrated to design-token utilities (auto dark-mode, no `dark:` variants needed):
- Form feedback messages → `text-danger` / `text-success` (equipments-form, rooms-form, users-form, profile, ticket-create/form, ticket-detail/ui, auth-reset, stock/{categories,movements,parts-form,plans,suppliers-form,tax-rates}, analytics/helpers).
- Priority badges → `success` (baixa), `warning` (média), `danger` (alta); crítico keeps `purple` (no state token exists for it — intentional exception). Affected: dashboard, tickets-management, ticket-detail/details, ticket-create/priority.
- Status/movement badges → `info`, `warning`, `success`, `danger` (rooms-management, equipments-management, users-management, audits/render, stock/{parts,movements,plans}/render, ticket-detail/details, analytics/kpi, analytics/charts legend).
- Raw `text-[var(--color-danger)]` → `text-danger` (tickets-management, users-management).
- No other changes needed: remaining files are api/dom/state/render modules already token-based or logic-only. Swagger and email logic untouched.
