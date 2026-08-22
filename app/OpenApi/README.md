# app/OpenApi

OpenAPI/Swagger specification definition for the L5-Swagger package.

## Files

| File | Purpose |
|---|---|
| `OpenApiSpec.php` | Defines global OpenAPI metadata: title, description, contact, server, security schemes, and tag descriptions |

## Notes for developers / AI

- This is a pure annotation container — no business logic.
- All `#[OA\*]` attributes are required by L5-Swagger for API documentation generation — do not strip them.
- Attribute values (title, descriptions, tag names) are user-facing — managed by i18n project.
