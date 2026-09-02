# app/OpenApi

OpenAPI/Swagger specification definition for the L5-Swagger package.

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as part of "The Library" -- API documentation that developers can browse interactively.

## Files

| File | Purpose |
|---|---|
| `OpenApiSpec.php` | A pure annotation container that defines the **global** OpenAPI metadata for the whole API: info block, server, security schemes, and tag descriptions |

---

## `OpenApiSpec.php`

**File:** `app/OpenApi/OpenApiSpec.php`

This file contains **no business logic and no runtime code** — it is a single `final class OpenApiSpec` whose only purpose is to be scanned by L5-Swagger for `#[OA\*]` attributes. The class body is empty (just a comment). All specifications are expressed as **PHP 8 attributes** using the `OpenApi\Attributes` namespace alias `OA`.

### Annotations (in file order)

| Attribute | Values defined |
|---|---|
| `#[OA\Info]` | `title: 'Fault Management API'`, `version: '1.0.0'`, `description: 'OpenAPI documentation for the ticket, equipment, audit, and reporting management application.'`, `contact` → name `'Maintenance and IT Department'`, email `'suporte@manutencao.local'` |
| `#[OA\Server]` | `url: '/api'`, `description: 'Main API Server'` — describes the base URL prefix for all API endpoints |
| `#[OA\SecurityScheme]` (`X-Auth-Token`) | `securityScheme: 'X-Auth-Token'`, `type: 'apiKey'`, `in: 'header'`, `name: 'X-Auth-Token'`, `description: 'Custom header-based authentication token'` — matches the header consumed by `App\Traits\Auditable`'s `resolveUserId()` and the API token flow |
| `#[OA\SecurityScheme]` (`BearerAuth`) | `securityScheme: 'BearerAuth'`, `type: 'http'`, `scheme: 'bearer'`, `bearerFormat: 'JWT'`, `description: 'JWT token based authentication'` — JWT bearer auth for the protected API |
| `#[OA\Tag]` (`Tickets`) | "Ticket management, history, statuses and comments" |
| `#[OA\Tag]` (`Users`) | "User management, profiles and authentication" |
| `#[OA\Tag]` (`Attachments`) | "File attachment management and upload" |
| `#[OA\Tag]` (`Analytics`) | "Maintenance performance reports and metrics" |
| `#[OA\Tag]` (`Stock`) | "Parts catalogue, suppliers, stock movements, dashboard and reports" |
| `#[OA\Tag]` (`Admin Stock`) | "Administrative management of parts, suppliers, VAT rates, categories and maintenance plans" |

### WHERE / WHEN it is used

L5-Swagger scans `app/` for these attributes when generating the interactive API documentation (typically via `php artisan l5-swagger:generate`, served under the L5-Swagger docs route). The `#[OA\Info]`, `#[OA\Server]`, security schemes, and tags are the **global scaffold** — individual endpoints, parameters, request bodies, and responses are documented with their own per-method `#[OA\*]` attributes elsewhere in the controllers/requests. The two security schemes (`X-Auth-Token` and `BearerAuth`) are the referenceable names used by those endpoint-level annotations.

### UPDATE / read-only rule

Do **not** modify undocumented endpoints here — this file is scoped to **global** metadata only. Per-endpoint documentation lives next to the controllers. The i18n project manages the user-facing strings (title, descriptions, tag names).

## Notes for developers / AI

- This is a pure annotation container — no business logic.
- All `#[OA\*]` attributes are required by L5-Swagger for API documentation generation — do not strip them.
- Attribute values (title, descriptions, tag names) are user-facing — managed by i18n project.
- Two independent auth schemes are defined (`X-Auth-Token` api-key header and `BearerAuth` JWT) — pick the matching reference name when annotating endpoints.
- `OpenApiSpec.php` is the **only** file here today; if endpoint-level specs are factored out later, they should be documented here too.