# app/Traits

Shared reusable PHP traits attached to Eloquent models and application services.

## Files

| File | Purpose |
|---|---|
| [`Auditable.php`](file:///home/nyapuma/Transferências/Projeto-Final-Cesae/app/Traits/Auditable.php) | Automatically records model lifecycle events (`created`, `updated`, `deleted`) to the `audits` table, capturing old/new attribute diffs, acting user ID, IP address, and user agent. |

## Notes for Developers & AI

- **Automatic Event Booting:** Uses Laravel's `bootAuditable()` trait booting convention. Any model including this trait will automatically intercept `created`, `updated`, and `deleted` lifecycle hooks.
- **Process Memory Cache:** `$resolvedUserId` is statically cached per HTTP request. In long-running workers (queue workers, Laravel Octane), call `Auditable::resetResolvedUserId()` to clear cached state between jobs.
- **Exception Safety:** All audit insertion calls are wrapped in `try/catch` blocks to prevent auditing logging failures from aborting primary business transactions.
